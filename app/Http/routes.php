<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () { return view('welcome'); });
Route::auth();
Route::post('/register', 'Auth\AuthController@postRegisterForm');
Route::get('/users/{username}', 'ProfileController@showUser');
Route::get('/users/{username}/statuses', 'ProfileController@showUserStatuses');

Route::group(['middleware'=>'auth'], function (){
    /**
    *   Set Profile Middleware
    **/
    Route::group(['middleware' => 'set_profile'], function () {

        # General
        Route::get('/my_profile', 'ProfileController@index');
        Route::get('/my_statuses', 'ProfileController@showLoggedUserStatuses');
        Route::get('/timeline', 'HomeController@index');

        # Settings routes
        Route::get('/settings', 'SettingsController@index')->name('settings');
        Route::post('/settings/profile', 'SettingsController@postPerfil')->name('settings.post.perfil');
        Route::post('/settings/password', 'SettingsController@postPassword')->name('settings.post.password');
        Route::post('/settings/avatar', 'SettingsController@postAvatar')->name('settings.post.avatar');

        # Search
        Route::get('/search', 'SearchController@getResults')->name('search.results');

        # Friends Routes
        Route::get('/friends', 'FriendController@index')->name('friends.index');
        Route::get('/friends/add/{username}', 'FriendController@getAdd')->name('friends.add');
        Route::get('/friends/accept/{username}', 'FriendController@getAccept')->name('friends.accept');
        Route::post('/friends/delete/{username}', 'FriendController@postDelete')->name('friends.delete');

        # Statuses routes
        Route::post('/status', 'StatusController@postStatus')->name('status.post');
        Route::post('/status/{statusId}/delete', 'StatusController@deleteStatus')->name('status.delete');
        Route::post('/status/{statusId}/reply', 'StatusController@postReply')->name('status.reply');
        Route::get('/status/{statusId}/like', 'StatusController@getLike')->name('status.like');
        Route::get('/status/{statusId}/unlike', 'StatusController@getUnlike')->name('status.unlike');

        # Professional Rate
        Route::get('/rate/{professional_id}/{vote}', 'RateController@rate')->name('professional.rate');


    });

    # Set profile routes
    ## GET
    Route::get('/set_profile', 'AssignController@getProfile');
    Route::get('/set_profile/deaf', 'AssignController@setDeafView');
    Route::get('/set_profile/familiar', 'AssignController@setFamiliarView');
    Route::get('/set_profile/professional', 'AssignController@setProfessionalView');
    Route::post('/add/interests', 'AssignController@setUserInterestsAjax');

    ## POST
    Route::post('/set_profile/deaf', 'AssignController@postDeaf');
    Route::post('/set_profile/familiar', 'AssignController@postFamiliar');
    Route::post('/set_profile/professional', 'AssignController@postProfessional');
});
