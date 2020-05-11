<?php

namespace App\Http\Controllers;

use App\Mail\BadgeVerified;
use App\User;
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
        $this->middleware('auth')->except('profile');
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
    public function team()
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
     * @return \Illuminate\View\View
     */
    public function team_store(Request $request)
    {
        return view('pages.team');
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
     * @return \Illuminate\View\View
     */
    public function team_invite(Request $request)
    {
        return view('pages.team');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function submit()
    {
        return view('pages.submit');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function submit_store(Request $request)
    {
        return view('pages.team');
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
            $response = $client->request('GET',  'https://api.youracclaim.com/v1/obi/v2/badge_assertions/'. Str::between($request->badge,'youracclaim.com/badges/','/public_url'));

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
                return back()->withErrors(['Badge Not Verified.', 'Course title should be Enterprise Design Thinking, Practitioner but got '.$res['evidence'][0]['name']]);
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
