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
		$redirect_after_login = Input::get('redirect_after_login');
		$redirect_after_login_url = Input::get('redirect_after_login_url');

		try
		{
			$user = Sentry::authenticate($credentials, false);
			$trainerGroup = Sentry::findGroupByName('trainer');


			if ($user)
			{
				Sentry::loginAndRemember($user);
				if ($redirect_after_login == 1) {
					if(\Request::ajax())
		        	{
		        		return \Response::json(route($redirect_after_login_url));
		        	}
		        	else{
		        		return Redirect::route($redirect_after_login_url);
		        	}
				}
				elseif ($user->inGroup($trainerGroup)) 
				{
					if(\Request::ajax())
		        	{
		        		return \Response::json(route('trainers.edit', $user->display_name));
		        	}
		        	else{
		        		return Redirect::route('trainers.edit', $user->display_name);
		        	}
				}
				else
				{
					if(\Request::ajax())
		        	{
		        		return \Response::json(route('users.edit', $user->display_name));
		        	}
		        	else{
		        		return Redirect::route('users.edit', $user->display_name);
		        	}
				}
				
				
			}
		}
		catch(\Exception $e)
		{
			if(\Request::ajax())
	        { 
				$result = array(
			            'validation_failed' => 1,
			            'errors' => $e->getMessage()
			    );	
				return \Response::json($result);
			}else{
				return Redirect::route('auth.login')->withErrors(array('login' => $e->getMessage()));
			}
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

	/**
	* Display the forgot password page
	* @return View
	*/
	public function getForgot()
	{
		return View::make('auth.forgot');
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

			\Event::fire('user.forgot', array(
	        	'email' => $user->email, 
	        	'displayName' => $user->display_name, 
	            'resetCode' => $reset_code
	        ));

	        return View::make('auth.forgot')->with('success','Now check your e-mails!')->with('message','You should have received an e-mail from us with a link to reset your password.' )->with('action', 'If you can&apos;t see the e-mail, please check your junk folder.<br>If it&apos;s not there either, contact us for further assistance.');
		}
		catch(\Exception $e)
		{
			return Redirect::route('auth.forgot')->withErrors(array('forgot' => $e->getMessage()));
		}
		catch(\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return Redirect::route('auth.forgot')->withErrors(array('forgot' => $e->getMessage()));
		}
	}

}