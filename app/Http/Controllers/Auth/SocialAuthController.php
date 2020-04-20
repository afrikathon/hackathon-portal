<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use eadortsu\GraphQL\Facades\Client;
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
            $query = '{
  user(login: "' . $providerUser->nickname . '") {
    topRepositories(first: 100, orderBy: {direction: DESC, field: UPDATED_AT}) {
      nodes {
        name
        languages(first: 1, orderBy: {direction: DESC, field: SIZE}) {
          nodes {
            name
          }
        }
      }
    }
  }
}
';


            $queryResponse = Client::fetch($query, 'https://api.github.com/graphql', [], env('GITHUB_TOKEN'));

            $githubData = $queryResponse->all();

            $languages = [];
            $languages_count = [];
            foreach ($githubData->user->topRepositories->nodes as $repo) {
                if (!empty($repo->languages->nodes)) {
                    array_push($languages, $repo->languages->nodes[0]->name);
                }
            }
            foreach ($languages as $language){
                $languages_count[$language] = count(array_keys($languages, $language));
            }
            $languages = array_unique($languages);
            $languages_count = array_unique($languages_count);


        }
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
                    'github' => $providerUser->user['html_url'],
                    'public_repos' => $providerUser->user['public_repos'],
                    'public_gist' => $providerUser->user['public_gists'],
                    'followers' => $providerUser->user['followers'],
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
                    'github' => $providerUser->user['html_url'],
                    'public_repos' => $providerUser->user['public_repos'],
                    'public_gist' => $providerUser->user['public_gists'],
                    'followers' => $providerUser->user['followers'],
                    'bio' => $providerUser->user['bio'],
                    'website' => $providerUser->user['blog'],
                    'username' => $providerUser->nickname,
                    'country' => $providerUser->user['location'],
                    'skills' => implode(',',$languages)
                ]);
            }
        }

        if ($driver == 'github') {

            $user->update([
                'languages' => serialize($languages_count)
            ]);

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
