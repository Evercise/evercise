<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showWelcome'));


Route::resource('users', 'UsersController');
Route::resource('sessions', 'SessionsController');
Route::resource('gyms', 'GymsController');
Route::resource('ratings', 'RatingsController');
Route::resource('evercisegroups', 'EvercisegroupsController');
Route::resource('trainers', 'TrainersController');

Route::get('sessions/{evercisegroup_id}/index', array('as'=>'sessions.index', 'uses'=>'SessionsController@index'));
Route::get('sessions/date_list', array('as'=>'sessions.date_list'));

Route::get('auth/login/{redirect_after_login_url}', array('as' => 'auth.login.redirect_after_login', function($redirect_after_login_url){
		return View::make('auth.login')->with('redirect_after_login', true)->with('redirect_after_login_url', $redirect_after_login_url );
}));
Route::get('auth/login', array('as' => 'auth.login', function(){
		return View::make('auth.login')->with('redirect_after_login', false)->with('redirect_after_login_url', false);
}));
Route::post('auth/login', array('as' => 'auth.login.post', 'uses' => 'auth\AuthController@postLogin'));
Route::get('auth/logout', array('as' => 'auth.logout', 'uses' => 'auth\AuthController@getLogout'));
Route::get('auth/forgot', array('as' => 'auth.forgot', 'uses' => 'auth\AuthController@getForgot'));
Route::post('auth/forgot', array('as' => 'auth.forgot.post', 'uses' => 'auth\AuthController@postForgot'));


Route::get('/users/{display_name}/activate/{code}', array('as' => 'users.activate', 'uses' => 'UsersController@activate'));
Route::get('/users/{display_name}/activate', array('as' => 'users.activatecodeless', 'uses' => 'UsersController@pleaseActivate'));
Route::get('/users/{display_name}/resetpassword/{code}', array('as' => 'users.resetpassword', 'uses' => 'UsersController@getResetPassword'));
Route::post('/users/resetpassword', array('as' => 'users.resetpassword.post', 'uses' => 'UsersController@postResetPassword'));

Route::get('/users/{display_name}/logout', array('as' => 'users.logout', 'uses' => 'UsersController@logout'));


Route::get('login/fb/{redirect_after_login_url}' , function($redirect_after_login_url) {
    $facebook = new Facebook(Config::get('facebook')); 
    $params = array(
        'redirect_uri' => url('/login/fb/callback/'.$redirect_after_login_url),
        'scope' => 'email,user_birthday,read_stream'
    );
    return Redirect::away($facebook->getLoginUrl($params));
});

Route::get('login/fb' , function() {
    $facebook = new Facebook(Config::get('facebook')); 
    $params = array(
        'redirect_uri' => url('/login/fb/callback/users.edit'),
        'scope' => 'email,user_birthday,read_stream'
    );
    return Redirect::away($facebook->getLoginUrl($params));
});


Route::get('login/fb/callback/{redirect_after_login_url}', array('as' => 'user.fb-login', 'uses' => 'UsersController@fb_login'));

//Route::get('login/fb/callback', array('as' => 'user.fb-login', 'uses' => 'UsersController@fb_login'));

Route::get('/evercisegroups/clone_evercisegroups/{id}', array('as' => 'evercisegroups.clone_evercisegroups', 'uses' => 'EvercisegroupsController@cloneEG'));
Route::post('/evercisegroups/delete_evercisegroups/{id}', array('as' => 'evercisegroups.delete_evercisegroups', 'uses' => 'EvercisegroupsController@deleteEG'));


Route::get('/widgets/upload', array('as' => 'widgets.upload', 'uses' => 'widgets\ImageController@getUploadForm'));
Route::post('/widgets/upload', array('as' => 'widgets.upload.post', 'uses' => 'widgets\ImageController@postUpload'));
Route::get('/widgets/crop', array('as' => 'widgets.crop', 'uses' => 'widgets\ImageController@getCrop'));
Route::post('/widgets/crop', array('as' => 'widgets.crop.post', 'uses' => 'widgets\ImageController@postCrop'));

Route::get('/widgets/map', array('as' => 'widgets.map', 'uses' => 'widgets\LocationController@getMap'));
Route::get('/widgets/mapForm', array('as' => 'widgets.map-form', 'uses' => 'widgets\LocationController@getGeo'));
Route::post('/widgets/postGeo', array('as' => 'widgets.postGeo', 'uses' => 'widgets\LocationController@postGeo'));

Route::get('/widgets/calendar', array('as' => 'widgets.calendar', 'uses' => 'widgets\CalendarController@getCalendar'));
Route::post('/widgets/calendar', array('as' => 'widgets.calendar', 'uses' => 'widgets\CalendarController@postCalendar'));

Route::get('/layouts/classBlock', array('as' => 'layouts.classBlock', 'uses' => 'widgets\EvercisegroupsController@block'));

Route::post('/postPdf', array('as' => 'postPdf', 'uses' => 'PdfController@postPdf'));

/* static pages */

Route::get('/{$view}', array('as' => 'static', 'uses' => 'staticController@show'));

/*

// uncomment for sql statement breakdown
Event::listen('illuminate.query', function($sql)
{
    var_dump($sql);
});
*/


Route::get('/user_marketingpreferences', function()
{
    $user = User::find(2);
    return $user->marketingpreferences()->where('name', 'newsletter')->first()['option'];
});
