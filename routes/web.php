<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify' => true]);

// Social Auth
Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('root');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.show', 'uses' => 'ProfileController@show']);
    Route::get('profile/edit', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
   /* Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);*/
    Route::get('profile/{user}', 'HomeController@profile')->name('profile');
    Route::get('/teams', 'HomeController@teams')->name('teams');
    Route::get('/team/{team}', 'HomeController@team')->name('team');
    Route::get('/team/create', 'HomeController@team_create')->name('team.create');
    Route::post('/team/store', 'HomeController@team_store')->name('team.store');
    Route::put('/team/{team}/update', 'HomeController@team_update')->name('team.update');
    Route::get('/team/{team}/invite/{invite}/accept', 'HomeController@team_accept')->name('team.invite.accept');
    Route::get('/team/{team}/invite/{invite}/decline', 'HomeController@team_decline')->name('team.invite.decline');
    Route::post('/team/{team}/invite', 'HomeController@team_invite')->name('team.invite');
    Route::get('/team/{team}/invite/{invite}', 'HomeController@team_invite_show')->name('team.invite.show');

    Route::get('/submit', 'HomeController@submit')->name('submit');
    Route::post('/submit/store', 'HomeController@submit_store')->name('submit.store');

    Route::post('/badge', 'HomeController@badge')->name('badge');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/home', function () {
        return Voyager::view('voyager::index');
    })->name('voyager.dashboard');
});

