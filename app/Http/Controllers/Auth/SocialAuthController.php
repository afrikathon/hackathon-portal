<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    /**
     * List of providers configured in config/services acts as whitelist
     *
     * @var array
     */
    protected $providers = [
        'github',
        'facebook',
        'google',
        'linkedin'
    ];

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the social login page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('auth.social');
    }

    /**
     * Redirect to provider for authentication
     *
     * @param $driver
     * @return mixed
     */
    public function redirectToProvider($driver)
    {
        if (!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    /**
     * Check for provider allowed and services configured
     *
     * @param $driver
     * @return bool
     */
    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }

    /**
     * Send a failed response with a msg
     *
     * @param null $msg
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    /**
     * Handle response of authentication redirect callback
     *
     * @param Request $request
     * @param $driver
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();

        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }


        // check for email in returned user
        return empty($user->email)
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        if ($driver == 'github') {
            $query = <<<QUERY
{
  user(login: "eadortsu") {
    topRepositories(first: 10, orderBy: {direction: DESC, field: UPDATED_AT}) {
      nodes {
        name
        languages(first: 4, orderBy: {direction: DESC, field: SIZE}) {
          nodes {
            name
          }
        }
      }
    }
  }
}
QUERY;


            $queryResponse = Alexaandrov\GraphQL\Facades\Client::fetch($query);

            dd($queryResponse);
        }

        dd($providerUser);
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();

        // if user already found
        if ($user) {
            // update the avatar and provider that might have changed
            $user->update([
                'avatar' => $providerUser->avatar,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
            if ($driver == 'github') {
                $user->update([
                    'github' => $providerUser->user->html_url,
                    'public_repos' => $providerUser->user->public_repos,
                    'public_gists' => $providerUser->user->public_gists,
                    'followers' => $providerUser->user->followers,
                ]);
            }
        } else {
            // create a new user
            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'avatar' => $providerUser->getAvatar(),
                'provider' => $driver,
                'provider_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
                // user can use reset password to create a password
                'password' => ''
            ]);
            if ($driver == 'github') {
                $user->update([
                    'github' => $providerUser->user->html_url,
                    'public_repos' => $providerUser->user->public_repos,
                    'public_gists' => $providerUser->user->public_gists,
                    'bio' => $providerUser->user->bio,
                    'website' => $providerUser->user->blog,
                    'username' => $providerUser->nickname,
                    'followers' => $providerUser->user->followers,
                    'country' => $providerUser->user->location,

                ]);
            }
        }

        // login the user
        Auth::login($user, true);

        return $this->sendSuccessResponse();
    }

    /**
     * Send a successful response
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendSuccessResponse()
    {
        return redirect()->intended('home');
    }
}
