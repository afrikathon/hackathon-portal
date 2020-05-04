<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('pages.team');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function teams()
    {
        return view('pages.teams');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function team_create()
    {
        return view('pages.team_create');
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
            $response = $client->request('GET',  $request->badge);

            $res = json_decode($response->getBody(), true); // '{"id": 1420053, "name": "guzzle", ...}'

            if ($res['evidence'][0]['name'] == "Enterprise Design Thinking, Practitioner") {
                auth()->user()->upadate([
                    'badge' => $request->badge,
                    'bade_verified' => '1'
                ]);
            } else {
                auth()->user()->update([
                    'badge' => $request->badge,
                    'badge_verified' => '0'
                ]);
            }
        } catch (\Exception $e) {
            auth()->user()->update([
                'badge' => $request->badge,
                'badge_verified' => '0'
            ]);
        }


        return redirect()->back();
    }

}
