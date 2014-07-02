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

Route::group(array('before' => 'auth'), function()
{
});

Route::resource('users', 'UsersController');
Route::resource('sessions', 'SessionsController');
Route::resource('gyms', 'GymsController');
Route::resource('ratings', 'RatingsController');
Route::resource('evercisegroups', 'EvercisegroupsController');
Route::resource('trainers', 'TrainersController');
Route::resource('venues', 'VenuesController');
Route::resource('payment', 'PaypalPaymentController');
Route::resource('wallets', 'WalletsController');

//Route::post('wallets/update', array('as'=>'wallets.update' , 'uses'=>'WalletsController@update'));

Route::get('trainers/{id}/edit/{tab}', array('as'=>'trainers.edit.tab', 'uses'=>'TrainersController@edit'));
Route::get('users/{id}/edit/{tab}', array('as'=>'users.edit.tab', 'uses'=>'UsersController@edit'));

Route::get('sessions/{evercisegroup_id}/index', array('as'=>'sessions.index', 'uses'=>'SessionsController@index'));
Route::get('sessions/date_list', array('as'=>'sessions.date_list'));
Route::post('sessions/join', array('as'=>'sessions.join' , 'uses'=>'SessionsController@joinSessions'));
Route::get('sessions/{evercisegroupId}/pay', array('as'=>'sessions.pay' , 'uses'=>'SessionsController@payForSessions'));

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

Route::get('/users/{display_name}/changepassword', array('as' => 'users.changepassword', 'uses' => 'UsersController@getChangePassword'));
Route::post('/users/changepassword', array('as' => 'users.changepassword.post', 'uses' => 'UsersController@postChangePassword'));

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
Route::post('/evercisegroups/delete/{id}', array('as' => 'evercisegroups.delete', 'uses' => 'EvercisegroupsController@deleteEG'));
/* geo evercise groups for searching */

Route::get('/evercisegroups/search/classes', array('as' => 'evercisegroups.search', 'uses' => 'EvercisegroupsController@searchEg'));

Route::get('/sessions/{id}/mail_all', array('as' => 'sessions.mail_all', 'uses' => 'SessionsController@getMailAll'));
Route::post('/sessions/{id}/mail_all', array('as' => 'sessions.mail_all.post', 'uses' => 'SessionsController@postMailAll'));
Route::get('/sessions/{sessionId}/mail_one/{userId}', array('as' => 'sessions.mail_one', 'uses' => 'SessionsController@getMailOne'));
Route::post('/sessions/{sessionId}/mail_one/{userId}', array('as' => 'sessions.mail_one.post', 'uses' => 'SessionsController@postMailOne'));
Route::get('/sessions/{sessionId}/mail_trainer/{trainerId}', array('as' => 'sessions.mail_trainer', 'uses' => 'SessionsController@getMailTrainer'));
Route::post('/sessions/{sessionId}/mail_trainer/{trainerId}', array('as' => 'sessions.mail_trainer.post', 'uses' => 'SessionsController@postMailTrainer'));
Route::get('/sessions/{sessionId}/leave', array('as' => 'sessions.leave', 'uses' => 'SessionsController@getLeaveSession'));
Route::post('/sessions/{sessionId}/leave', array('as' => 'sessions.leave.post', 'uses' => 'SessionsController@postLeaveSession'));
Route::get('/sessions/{evercisegroupId}/paywithevercoins', array('as' => 'sessions.paywithevercoins', 'uses' => 'SessionsController@getPayWithEvercoins'));
Route::post('/sessions/{evercisegroupId}/paywithevercoins', array('as' => 'sessions.paywithevercoins.post', 'uses' => 'SessionsController@postPayWithEvercoins'));
Route::get('/sessions/{sessionId}/refund', array('as' => 'sessions.refund', 'uses' => 'SessionsController@getRefund'));
Route::post('/sessions/{sessionId}/refund', array('as' => 'sessions.refund.post', 'uses' => 'SessionsController@postRefund'));


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
/* all static pages use the same controller and  points the the vew based on the current route*/

Route::get('about', array('as' => 'static.about', 'uses' => 'StaticController@show'));
Route::get('terms_of_use', array('as' => 'static.terms_of_use', 'uses' => 'StaticController@show'));
Route::get('privacy', array('as' => 'static.privacy', 'uses' => 'StaticController@show'));
Route::get('the_team', array('as' => 'static.the_team', 'uses' => 'StaticController@show'));
Route::get('faq', array('as' => 'static.faq', 'uses' => 'StaticController@show'));
Route::get('class_guidelines', array('as' => 'static.class_guidelines', 'uses' => 'StaticController@show'));
Route::get('contact_us', array('as' => 'static.contact_us', 'uses' => 'StaticController@show'));
Route::get('how_it_works', array('as' => 'static.how_it_works', 'uses' => 'StaticController@show'));
Route::get('test', array('as' => 'static.test', 'uses' => 'StaticController@show'));


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

Route::get('/email_test', function(){
    return View::make('emails.session.userList')
    ->with('dateTime', '2014-09-19 05:00:00')
    ->with('name', 'Wayne Junior')
    ->with('group', 'Bellyflopping')
    ->with('location', 'The Biscuit Factory')
    ->with('trainerEmail', 'trainer@email.com')
    ->with('trainerName', 'Jeff the trainer')
    ->with('location', 'The Biscuit Factory')
    ->with('userList', ['bob'=>'bob@hisownface.com', 'fred'=>'fred@theshop.com']);
});

/* ADMIN SECTION */


Route::get('admin/pending_trainers', array('as' => 'admin.pending', 'before'=>'admin', 'uses' => 'AdminController@pendingTrainers'));
Route::post('admin/approve_trainer', array('as' => 'admin.approve_trainer.post', 'before'=>'admin', 'uses' => 'AdminController@approveTrainer'));

Route::get('admin/pending_withdrawal', array('as' => 'admin.pending_withdrawal', 'before'=>'admin', 'uses' => 'AdminController@pendingWithdrawal'));
Route::post('admin/process_withdrawal', array('as' => 'admin.process_withdrawal.post', 'before'=>'admin', 'uses' => 'AdminController@processWithdrawal'));
