<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('users.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(
			Input::all(),
			array(
				'display_name' => 'required|max:20|min:5|unique:users',
				'first_name' => 'required|max:50|min:2',
				'last_name' => 'required|max:50|min:2',
				'email' => 'required|email|unique:users',
				'password' => 'required|confirmed',
			)
		);
		if($validator->fails()) {
			if(Request::ajax())
	        { 
	        	$result = array(
		            'validation_failed' => 1,
		            'errors' =>  $validator->errors()->toArray()
		         );	

				return Response::json($result);
	        }else{
	        	return Redirect::route('users.edit')
					->withErrors($validator)
					->withInput();
	        }
		}
		else{
			$display_name = Input::get('display_name');
			$first_name = Input::get('first_name');
			$last_name = Input::get('last_name');
			$email = Input::get('email');
			$password = Input::get('password');
			$gender = Input::get('gender');

			$user = Sentry::register(array(
				'display_name' => $display_name,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
				'password' => $password,
				'gender' => $gender,
				'activated' => false
			));

			$userGroup = Sentry::findGroupById(1);
			$user->addGroup($userGroup);

			$activation_code = $user->getActivationCode();

			if($user) {
				if(Request::ajax())
	        	{
					Event::fire('user.signup', array(
		            	'email' => $user->email, 
		            	'display_name' => $user->display_name, 
		                'activationCode' => $activation_code
		            ));

					$this->makeUserDir($user);

					return Response::json(route('users.activate', array('display_name'=> $user->display_name)));
				}
			}
		}

		//return Input::all();

	}

	public function fb_login()
	{
	    $code = Input::get('code');

	    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
	 
	    $facebook = new Facebook(Config::get('facebook'));
	    $uid = $facebook->getUser();
	 
	    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');
	 
	    $me = $facebook->api('/me');

	    $password = $this->randomPassword();

	    try{
		    $user = Sentry::createUser(array(
				'display_name' => $me['username'],
				'first_name' => $me['first_name'],
				'last_name' => $me['last_name'],
				'email' => $me['email'],
				'password' => $password,
				'gender' => $me['gender'],
				'activated' => true
			));

			$userGroup = Sentry::findGroupById(1);
			$user->addGroup($userGroup);

			$userGroup = Sentry::findGroupById(2);
			$user->addGroup($userGroup);

			if($user) {

				//  TODO - Make new email for FB signup ("here's your password" instead of "click the link")
				Event::fire('user.signup', array(
		        	'email' => $user->email, 
		        	'display_name' => $user->display_name, 
		            'password' => $password
		        ));

				$this->makeUserDir($user);
				
				$path = public_path().'/profiles/'.date('Y-m');
				$img_filename = 'facebook-image-'.$user->display_name.'-'.date('d-m').'.jpg';
				$url = 'http://graph.facebook.com/' . $me["username"] . '/picture?type=large';
				//$url = 'http://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash3/t1.0-1/c53.45.557.557/s200x200/936888_10152789400300290_1726812964_n.jpg';
/*	
				$contents = File::get($url);//'https://graph.facebook.com/'.$me["id"].'/picture?type=large');
				File::put($path.'/'.$user->id.'_'.$user->display_name.'/facebook-image.jpg', $contents);
*/

/*				$file_handler = fopen($path.'/'.$user->id.'_'.$user->display_name.'/facebook-image.jpg', 'w');
				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_FILE, $file_handler);
				curl_setopt($curl, CURLOPT_HEADER, 0);
				curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				curl_exec($curl);

				curl_close($curl);
				fclose($file_handler);
*/

				$img = 'woo';//file_get_contents($url);
				file_put_contents($path.'/'.$user->id.'_'.$user->display_name.'/'.$img_filename, $img);

				$user->image = $img_filename;

				$user->save();

				Sentry::login($user, false); // TODO - Does not seem to work

				return Redirect::route('users.activatecodeless', array('display_name'=>$user->display_name))->with('activation',3);
				//return View::make('users.show');
			}
	    }
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			try
			{
				$user = Sentry::findUserByLogin($me['email']);
			    Sentry::login($user,false);
			    return Redirect::route('users.edit', $user->display_name);
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
				$user = Sentry::findUserByLogin($me['email']);
				return View::make('users.activate')->with('activation', 1)->with('display_name', $user->display_name);
			}
		}


		//return View::make('users.activate')->with('activation', 3)->with('display_name', $user->display_name);

	}

	public function makeUserDir($user)
	{

        $path = public_path().'/profiles/'.date('Y-m');

        if(!file_exists($path)) File::makeDirectory($path);

        File::makeDirectory($path.'/'.$user->id.'_'.$user->display_name);
        $user->directory = date('Y-m').'/'.$user->id.'_'.$user->display_name;

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('users.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('users.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return View::make('users.update');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Activate the user using the emailed hash
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function activate($display_name, $code)
	{
		$user = 0;
		if ($code)
		{
			try
			{
				$user = Sentry::findUserByActivationCode($code);
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
		        // User activation failed
			}
		}
		if ($user)
		{
			if ($user->attemptActivation($code))
		    {
		        // User activation passed
		        $display_name = $user->display_name;
				return View::make('users.activate')->with('activation', 2)->with('display_name', $display_name);
		    }
		}
	    if (!$user)
	    {
	        // User activation failed
	    	return View::make('users.activate')->with('activation', 0)->with('display_name', $display_name);
	    }

	}

	/**
	 * Activate the user using the emailed hash
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function pleaseActivate($display_name)
	{
		
	    return View::make('users.activate')->with('display_name', $display_name);
	    

	}
	/**
	 * Reset the user's password using the emailed hash
	 *
	 * @param  int  $id
	 * @return View
	 */
	public function getResetPassword($display_name, $code)
	{
		try
		{
		    $user = Sentry::findUserByResetPasswordCode($code);
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return View::make('users.resetpassword')->with('message', 'Cannot find user');
		}
		
		return View::make('users.resetpassword')->with('code', $code);
	}

	/**
	 * Reset the user's password using the emailed hash
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postResetPassword()
	{

		$validator = Validator::make(
			Input::all(),
			array(
				'email' => 'required|email',
				'password' => 'required|confirmed',
			)
		);

		// TODO - Finish validation !!!!!!!!!!!!!!!

		$email = Input::get('email');
		$password = Input::get('password');
		$code = Input::get('code');

		if($validator->fails()) {

			if(Request::ajax())
	        { 
	        	$result = array(
		            'validation_failed' => 1,
		            'errors' =>  $validator->errors()->toArray()
		         );	

				return Response::json($result);
	        }else{
	        	return Redirect::route('users.resetpassword')
					->withErrors($validator)
					->withInput();
	        }
    	}
    	else
    	{
    		$success = false;
			try
			{
			    $user = Sentry::findUserByLogin($email);

			    if ($user->checkResetPasswordCode($code))
			    {


			        // Attempt to reset the user password
			        if ($user->attemptResetPassword($code, $password))
			        {
			        	$success = true;
			        }
			    }
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    //return View::make('users.resetpassword')->with('message', 'Could not find user. Please check your email address');
			}
			if ($success)
			{
	        	if(Request::ajax())
	        	{
		    		Session::flash('notification', 'Password reset successful');
		    		return Response::json(route('home'));
		    	}
		    	else
		    	{
		    		return View::make('home')->with('notification', 'Password Reset Successful');
		    	}
	    	}
	    	else
	    	{
	        	$result = array(
		            'validation_failed' => 1,
		            'errors' =>  array('email'=>array(0=>'Wrong email'))
		         );	

				return Response::json($result);
	    	}

    	}

	}

	public function getLoginStatus()
	{
		return View::make('users.loginStatus');
	}

	/**
	 * Logout Action
	 *
	 * @return Redirect
	 */
	public function logout()
	{
		//return View::make('users.resetpassword');
		Sentry::logout();
		return Redirect::route('home');
	}

}