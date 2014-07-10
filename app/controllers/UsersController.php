<?php

use SammyK\FacebookQueryBuilder\FQB;
use SammyK\FacebookQueryBuilder\FacebookQueryBuilderException;

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return View
	 */
	public function index()
	{
		if (!Sentry::check()) return Redirect::route('home');

		JavaScript::put(array('initUsers' => 1 )); // Initialise Users JS.
		return View::make('users.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return View
	 */
	public function create()
	{
		$referralCode = Referral::checkReferralCode(Session::get('referralCode'));

		JavaScript::put(array('initUsers' => 1 )); // Initialise Users JS.
		return View::make('users.create')->with('referralCode', $referralCode);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$dt = new DateTime();
		$before = $dt->sub(new DateInterval('P16Y'));
		$dateBefore=  $before->format('Y-m-d');
		$after = $dt->sub(new DateInterval('P104Y'));	
		$dateAfter=  $after->format('Y-m-d');

		Validator::extend('has', function($attr, $value, $params) {
		    if (!count($params)) {
		        throw new \InvalidArgumentException('The has validation rule expects at least one parameter, 0 given.');
		    }
		    
		    foreach ($params as $param) {
		        switch ($param) {
		            case 'num':
		                $regex = '/\pN/';
		                break;
		            case 'letter':
		                $regex = '/\pL/';
		                break;
		            case 'lower':
		                $regex = '/\p{Ll}/';
		                break;
		            case 'upper':
		                $regex = '/\p{Lu}/';
		                break;
		            case 'special':
		                $regex = '/[\pP\pS]/';
		                break;
		            default:
		                $regex = $param;
		        }
		        
		        if (! preg_match($regex, $value)) {
		            return false;
		        }
		    }
		    
		    return true;
		});
		

		$validator = Validator::make(
			Input::all(),
			[
				'display_name' => 'required|max:20|min:5|unique:users',
				'first_name' => 'required|max:50|min:3',
				'last_name' => 'required|max:50|min:3',
				'dob' => 'required|date_format:Y-m-d|after:'.$dateAfter.'|before:'.$dateBefore,
				'email' => 'required|email|unique:users',
				'password' => 'required|confirmed|min:6|max:32|has:upper,lower,num',
			],
			['password.has' => 'The password must contain at least one upper and one lower case letter and a number.',]


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
			$dob = Input::get('dob');
			$email = Input::get('email');
			$password = Input::get('password');
			$area_code = Input::get('areacode');
			$phone = Input::get('phone');
			$gender = Input::get('gender');
			$newsletter = Input::get('userNewsletter');


			$user = Sentry::register(array(
				'display_name' => str_replace(' ', '_', $display_name),
				'first_name' => $first_name,
				'last_name' => $last_name,
				'dob' => $dob,
				'email' => $email,
				'area_code' => $area_code,
				'phone' => $phone,
				'password' => $password,
				'gender' => $gender,
				'activated' => true,
			));

			$userGroup = Sentry::findGroupById(1);
			$user->addGroup($userGroup);

			/*$marketingpreferences = Marketingpreference::where('name', '=', 'newsletter')->get();
			$chosenPreference = 1;
			foreach ($marketingpreferences as $pref)
			{
			    if ($pref->option == $newsletter) $chosenPreference = $pref->id;
			}


			$user_marketingpreferences = User_marketingpreference::create(array('user_id'=>$user->id, 'marketingpreference_id'=>$chosenPreference));
*/

			Evercoin::create(['user_id'=>$user->id, 'balance'=>0]);
			Milestone::create(['user_id'=>$user->id]);
			Token::create(['user_id'=>$user->id]);

			$referral = Referral::useReferralCode(Session::get('referralCode'), $user->id);
			if( $referral )
			{
				Milestone::where('user_id', $referral->user_id)->first()->add('referral');
				Milestone::where('user_id', $user->id)->first()->freeCoin('referral_signup');
			}
			

			if($user) {
				if(Request::ajax())
	        	{

	        		$activation_code = $user->getActivationCode();
					
					Event::fire('user.signup', array(
		            	'email' => $user->email, 
		            	'display_name' => $user->display_name, 
		                'activationCode' => $activation_code
		            ));
		            

					$this->makeUserDir($user);

					$user->save();

					Sentry::login($user, true);

					//return Response::json(route('users.activate', array('display_name'=> $user->display_name)));
					return Response::json(route('users.edit.tab', [$user->id ,'profile']));
					//return Redirect::route('users.edit', $user->display_name);
					//return Response::json($newsletter); // for testing
				}
			}
		}

		//return Input::all();
 
	}

	public function fb_login()
	{
	    // Use a single object of a class throughout the lifetime of an application.
	    $application = Config::get('facebook');
	    $permissions = 'publish_stream,email,user_birthday,read_stream';
	    $url_app = Request::root().'/login/fb';
	    //echo $url_app;exit;

	    // getInstance
	    FacebookConnect::getFacebook($application);
		$getUser = FacebookConnect::getUser($permissions, $url_app); // Return facebook User data

		//return View::make('users.tokens')->with('fb', $getUser);
		

	    if (!$getUser) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

		$me = $getUser['user_profile'];
	

	    $password = Functions::randomPassword(8);

	    $dob = isset( $me['birthday'] ) ? new DateTime($me['birthday']) : '';
	    
	    try{
		    $user = Sentry::createUser(array(
				'display_name' => str_replace(' ', '_', $me['name']),
				'first_name' => $me['first_name'],
				'last_name' => $me['last_name'],
				'dob' => $dob,
				'email' => $me['email'],
				'password' => $password,
				'gender' => isset($me['gender']) ? $me['gender'] : '',
				'activated' => true,
			));

			if($user) {


				$userGroup = Sentry::findGroupById(1);
				$user->addGroup($userGroup);

				$userGroup = Sentry::findGroupById(2);
				$user->addGroup($userGroup);

				Evercoin::create(['user_id'=>$user->id, 'balance'=>0]);
				Milestone::create(['user_id'=>$user->id]);

				$referral = Referral::useReferralCode(Session::get('referralCode'), $user->id);
				if( $referral )
				{
					Milestone::where('user_id', $referral->user_id)->first()->add('referral');
					Milestone::where('user_id', $user->id)->first()->freeCoin('referral_signup');
				}
				
				Token::create(['user_id'=>$user->id]);
				$token = Token::where('user_id', $user->id)->first();
				$token->addToken('facebook', Token::makeFacebookToken($getUser));

				User::find($user->id)->marketingpreferences()->attach(1);
				
				Event::fire('user.fb_signup', array(
		        	'email' => $user->email, 
		        	'display_name' => $user->display_name, 
		            'password' => $password
		        ));

				$this->makeUserDir($user);
				
				$path = public_path().'/profiles/'.date('Y-m');
				$img_filename = 'facebook-image-'.$user->display_name.'-'.date('d-m').'.jpg';
				$url = 'http://graph.facebook.com/' . $me['id'] . '/picture?width=200&height=200';

				try
				{
					$img = file_get_contents($url);
					file_put_contents($path.'/'.$user->id.'_'.$user->display_name.'/'.$img_filename, $img);
				}catch (Exception $e)
				{
					// This exception will happen from localhost, as pulling the file from facebook will not work
					$img_filename = '';
				}

				$user->image = $img_filename;

				$user->save();

				Sentry::login($user, false);

				return Redirect::route('users.edit.tab', [$user->id ,'profile'])->with('notification','you have successfully signed up with facebook, Your password has been emailed to you' );
				//return Redirect::route('users.activatecodeless', array('display_name'=>$user->display_name))->with('activation',3);	
				//return View::make('users.show');
			}
	    }
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			try
			{
				$user = Sentry::findUserByLogin($me['email']);
			    Sentry::login($user,false);
			    $trainerGroup = Sentry::findGroupByName('trainer');

			    /*if ($redirect_after_login_url && $redirect_after_login_url != 'users.edit') {
					return Redirect::route($redirect_after_login_url);
				}
				else*/if ($user->inGroup($trainerGroup)) 
				{
					return Redirect::route('trainers.edit', $user->display_name);
				}
				else
				{
			    	return Redirect::route('users.edit', $user->display_name);
				}
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
				$user = Sentry::findUserByLogin($me['email']);
				return View::make('users.edit')->with('notification', 'you have successfully signed up with facebook. Your password has been emailed to you')->with('display_name', $user->display_name);
			}
		}


		//return View::make('users.activate')->with('activation', 3)->with('display_name', $user->display_name);

	}

	public function makeUserDir($user)
	{
        $path = public_path().'/profiles/'.date('Y-m');
        $userFolder = $path.'/'.$user->id.'_'.$user->display_name;
		try
		{


	        if(!file_exists($path)) File::makeDirectory($path);
	        if(!file_exists($userFolder)) File::makeDirectory($userFolder);

	        $user->directory = date('Y-m').'/'.$user->id.'_'.$user->display_name;
		}
		catch (Exception $e)
		{
			echo 'Cannot make user folder : '.$path.'<br>';
			echo 'public_path() : '.public_path().'<br>';
			echo $e;
			exit;
		}


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if (!Sentry::check()) return Redirect::route('home');

		return View::make('users.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, $tab=0)
	{
		if (!Sentry::check()) return Redirect::route('home');

		JavaScript::put(array('initPut' => json_encode(['']) ));
		JavaScript::put(array('initUsers' => 1 ));
		JavaScript::put(array('initDashboardPanel' => 1 )); // Initialise title swap Trainer JS.
		JavaScript::put(array('selectTab' => ['tab'=>$tab] ));

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

		$validator = Validator::make(
			Input::all(),
			array(
				'first_name' => 'required|max:50|min:2',
				'last_name' => 'required|max:50|min:2',
				'dob' => 'required',
				'email' => 'required|email',
				// 'old_password' => 'required',
				// 'new_password' => 'confirmed',
				//'thumbFilename' => 'required',
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
			// Actually update the user record 

			//$old_password = Input::get('old_password');
			//$new_password = Input::get('new_password');
			$first_name = Input::get('first_name');
			$last_name = Input::get('last_name');
			$dob = Input::get('dob');
			$email = Input::get('email');
			$gender = Input::get('gender');
			$newsletter = Input::get('userNewsletter');
			$image = Input::get('thumbFilename');
			$area_code = Input::get('areacode');
			$phone = Input::get('phone');

			//$user = Sentry::getUser();

			/*if (!$user->checkPassword($old_password))
			{
				$result = array(
		            'validation_failed' => 1,
		            'errors' =>  array(
		            	'old_password'=>array(
		            		'Your current password is incorrect'
	            		)
	            	)
		         );	

				return Response::json($result);
			}
			if ($new_password)
			{
				$user->update(array(
					'password' => $new_password,
				));
			}*/

			$this->user->update(array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'dob' => $dob,
				'email' => $email,
				'gender' => $gender,
				'image' => $image,
				'area_code' => $area_code,
				'phone' => $phone,
			));
			/*
			$savedNewsletter = User::find($this->user->id)->marketingpreferences()->where('name', 'newsletter')->first()['option'];
			if ($newsletter != $savedNewsletter)
			{
				User::find($this->user->id)->marketingpreferences()->where('name', 'newsletter')->detach();
				User::find($this->user->id)->marketingpreferences()->attach($newsletter == 'yes' ? true : false);
			}
			*/

			if(
					$this->user->gender
				&&	$this->user->dob
				&&	$this->user->phone
				&&	$this->user->image
			) Milestone::where('user_id', $this->user->id)->first()->add('profile');

			return Response::json(['callback' => 'gotoUrl', 'url' => Request::root().'/users/'.$this->user->id.'/edit/profile']);

		}
		//return Response::json($result);
		//return View::make('users.edit');
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
				//return View::make('users.activate')->with('activation', 2)->with('display_name', $display_name);
				return View::make('home')->with('notification', 'Your account has been successfuly activated');
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
	public function getChangePassword($display_name)
	{
		// Init JS from composer as used for trainers as well as users	
		return View::make('users.changepassword');
	}

	/**
	 * Reset the user's password using the emailed hash
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postChangePassword()
	{

		$validator = Validator::make(
			Input::all(),
			array(
				'old_password' => 'required',
				'new_password' => 'required|confirmed|min:5',
			)
		);

		$oldPassword = Input::get('old_password');
		$newPassword = Input::get('new_password');

		if($validator->fails()) {

			if(Request::ajax())
	        { 
    			return Response::json(['validation_failed' => 1, 'errors' => $validator->errors()->toArray()]);
	        }else{
	        	return Redirect::route('users.resetpassword')
					->withErrors($validator)
					->withInput();
	        }
    	}
    	else
    	{
    		if ($oldPassword == $newPassword)
    		{
    			return Response::json(['validation_failed' => 1, 'errors' => ['new_password'=>'your new password matches your old password']]);
    		}
    		if ($this->user->checkPassword($oldPassword))
    		{
    			$this->user->password = $newPassword;
    			$this->user->save();
    			return Response::json(['result'=>'changed', 'callback' => 'successAndRefresh']);
    		}
    		return Response::json(['validation_failed' => 1, 'errors' => ['old_password'=>'Current password incorrect']]);
    	}
    }

	/**
	 * Reset the user's password using the emailed hash
	 *
	 * @param  int  $id
	 * @return View
	 */
	public function getResetPassword($display_name, $code)
	{
		JavaScript::put(array('initUsers' => 1 )); // Initialise Users JS.
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