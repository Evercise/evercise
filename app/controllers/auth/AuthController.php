<?php namespace auth;

use Auth, BaseController, Form, Input, Redirect, Sentry, View;

class AuthController extends \BaseController {

	/**
	* Display the login page
	* @return View
	*/
	public function getLogin()
	{
		return View::make('auth.login');
	}

	/**
	* Login action
	* @return Redirect
	*/
	public function postLogin()
	{
		$credentials = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
		);

		try
		{
			$user = Sentry::authenticate($credentials, false);

			if ($user)
			{
				var_dump($user);
				exit;
				//return Redirect::route('users.edit', $user->username);
			}
		}
		catch(\Exception $e)
		{
			return Redirect::route('auth.login')->withErrors(array('login' => $e->getMessage()));
		}
	}

	/**
	* Logout action
	* @return Redirect
	*/
	public function getLogout()
	{
		Sentry::logout();

		return Redirect::route('auth.login');
	}

}