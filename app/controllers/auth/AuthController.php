<?php namespace auth;

use Auth, BaseController, Form, Input, Redirect, Sentry, View, Cookie;

class AuthController extends \BaseController {

	/**
	* Logout action
	* @return Redirect
	*/
	public function getLogout()
	{
		Sentry::logout();

		return Redirect::route('home');
	}

	/**
	* Display the forgot password page
	* @return View
	*/
	public function getForgot()
	{
		return View::make('v3.auth.forgot');
	}

	/**
	* Forgot password action
	* @return Redirect
	*/
	public function postForgot()
	{
		try
		{
			$email = Input::get('email');
			$user = Sentry::findUserByLogin($email);

			$reset_code = $user->getResetPasswordCode();
			$user->sendForgotPasswordEmail($reset_code);

	        return View::make('v3.auth.forgot')->with('success','Now check your e-mails!')->with('message','You should have received an e-mail from us with a link to reset your password.' )->with('action', 'If you can&apos;t see the e-mail, please check your junk folder.<br>If it&apos;s not there either, contact us for further assistance.');
		}
		catch(\Exception $e)
		{
			return Redirect::route('auth.forgot')->withErrors(['forgot' => $e->getMessage()]);
		}
		catch(\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return Redirect::route('auth.forgot')->withErrors(['forgot' => $e->getMessage()]);
		}
	}

}