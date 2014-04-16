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

Route::get('/', function()
{
	return View::make('hello');
});


Route::resource('users', 'UsersController');
Route::resource('groups', 'groupsController');
Route::resource('sessions', 'sessionsController');
Route::resource('gyms', 'gymsController');
Route::resource('ratings', 'ratingsController');

Route::get('auth/login', array('as' => 'auth.login', 'uses' => 'auth\AuthController@getLogin'));
Route::get('auth/logout', array('as' => 'auth.logout', 'uses' => 'auth\AuthController@getLogout'));
Route::post('auth/login', array('as' => 'auth.login.post', 'uses' => 'auth\AuthController@postLogin'));
