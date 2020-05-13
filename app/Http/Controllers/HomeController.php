<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Mail\BadgeVerified;
use App\Submission;
use App\Team;
use App\TeamMember;
use App\User;
use Google\Cloud\Storage\StorageClient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['profile']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function team(Team $team)
    {
        return view('teams.show');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function teams()
    {
        return view('teams.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function team_create()
    {
        return view('teams.create');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function team_store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:teams|max:255',
        ]);
        $team = Team::create([
            'lead_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'code' => Str::slug($request->name),
            'github' => "",
        ]);
        TeamMember::create([
            'team_id' => $team->id,
            'user_id' => auth()->id()
        ]);

        $client2 = new Client();
        $res2 = $client2->request('POST', 'https://slack.com/api/conversations.create',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('SLACK_TOKEN'),
                    'Content-type' => 'application/json'
                ],
                'json' => [
                    "name" => Str::lower( 'team-'.Str::slug($request->name)),
                    "is_private" => false
                ]
            ]);

        $client = new Client();
        $res = $client->request('POST', 'https://api.github.com/repos/afrikathon/temp/generate',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('GITHUB_TOKEN'),
                    'Accept' => 'application/vnd.github.baptiste-preview+json'
                ],
                'json' => [
                    "owner" => "afrikathon",
                    "name" => Str::lower( 'team-'.Str::slug($request->name)),
                    "description" => $request->description,
                    "private" => false
                ]
            ]);
        $ress = json_decode($res->getBody(), true);
        $team->github = $ress['html_url'];
        $team->save();


        return redirect()->back();
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function team_update(Request $request,Team $team)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $team = $team->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->back();
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function team_join(Request $request)
    {
        return view('pages.team');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @param Team $team
     * @param Invite $invite
     * @return \Illuminate\Http\RedirectResponse
     */
    public function team_accept(Request $request, Team $team, Invite $invite)
    {
        $invite->update([
           'status' => "Accepted"
        ]);
        TeamMember::create([
            'team_id' => $team->id,
            'user_id' => auth()->id()
        ]);
        return redirect()->route('teams');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @param Team $team
     * @param Invite $invite
     * @return \Illuminate\Http\RedirectResponse
     */
    public function team_decline(Request $request, Team $team, Invite $invite)
    {
        $invite->update([
            'status' => "Decline"
        ]);
        return redirect()->route('teams');
    }
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function team_invite(Request $request,Team $team)
    {
        $invite = Invite::create([
            'team_id' => $team->id,
            'user_id' => auth()->id(),
            'email' => $request->email,
            'message' => $request->message,
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->email;
        Mail::to($user)->send(new \App\Mail\Invite($invite));
        return redirect()->back();
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function team_invite_show(Team $team, Invite $invite)
    {
        return view('teams.invite',['team'=>$team,'invite'=>$invite]);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function submit()
    {
        if( \App\TeamMember::where('user_id',auth()->id())->count() < 1 ){
            return redirect()->route('root');
        }else{
            $memberof = \App\TeamMember::where('user_id',auth()->id())->first();
            $team = $memberof->team;
            if (Submission::where('team_id',$team->id)->count() < 1) {
                $submition =  Submission::create([
                    'team_id' => $team->id,
                ]);
            }
        }
        return view('pages.submit',['team'=>$team]);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function submit_store(Request $request)
    {


       /* // Authenticating with a keyfile path.
        $storage = new StorageClient([
            'keyFilePath' => storage_path('app/key.json')
        ]);
        $bucket = $storage->bucket('afrikathon');
        $object = $bucket->object('submissions_2020');
        $object = $bucket->upload(
            fopen($request->file->path(), 'r'),
            [
                'resumable' => true,
                'name' => 'submissions_2020/new-name.jpg',
                'metadata' => [
                    'contentLanguage' => 'en'
                ]
            ]
        );

        return $object->info();*/

        if( \App\TeamMember::where('user_id',auth()->id())->count() < 1 ){
            return redirect()->route('root');
        }
        $memberof = \App\TeamMember::where('user_id',auth()->id())->first();
        $team = $memberof->team;

        if (Submission::where('team_id',$team->id)->count() >= 1){
          $submition =  Submission::where('team_id',$team->id)->first();
            $submition->update($input = $request->only([
                'title', 'description','problem','solution'
            ]));
        }else{
            $submition =  Submission::create([
                'team_id' => $team->id,
            ]);
            $submition->update($input = $request->only([
                'title', 'description','problem','solution'
            ]));
        }
        return redirect()->back()->withStatus('Your team submssion`s has been updated');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function badge(Request $request)
    {
        $validatedData = $request->validate([
            'badge' => 'required|url',
        ]);

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', 'https://api.youracclaim.com/v1/obi/v2/badge_assertions/' . Str::between($request->badge, 'youracclaim.com/badges/', '/public_url'));

            $res = json_decode($response->getBody(), true);


            if ($res['evidence'][0]['name'] == "Enterprise Design Thinking, Practitioner") {
                auth()->user()->update([
                    'badge' => $request->badge,
                    'badge_verified' => '1'
                ]);
                $user = new User([
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email
                ]);
                Mail::to($user)->send(new BadgeVerified($user));
            } else {
                auth()->user()->update([
                    'badge' => $request->badge,
                    'badge_verified' => '0'
                ]);
                return back()->withErrors(['Badge Not Verified.', 'Course title should be Enterprise Design Thinking, Practitioner but got ' . $res['evidence'][0]['name']]);
            }
        } catch (\Exception $e) {
            auth()->user()->update([
                'badge' => null,
                'badge_verified' => '0'
            ]);
            return back()->withErrors(__('Badge Not Verified. Invalid badge URL'));
        }


        return back()->withStatus(__('Badge successfully Verified.'));
    }

}
