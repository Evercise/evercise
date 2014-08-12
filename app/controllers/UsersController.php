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
		JavaScript::put(array('initPut' => 1 ));
		JavaScript::put(array('initToolTip' => 1 )); //Initialise tooltip JS.
		return View::make('users.register')->with('referralCode', $referralCode);
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
		
		// validation rules for input field on register form
		$validator = Validator::make(
			Input::all(),
			[
				'display_name' => 'required|max:20|min:5|unique:users',
				'first_name' => 'required|max:15|min:3',
				'last_name' => 'required|max:15|min:3',
				'dob' => 'required|date_format:Y-m-d|after:'.$dateAfter.'|before:'.$dateBefore,
				'email' => 'required|email|unique:users',
				'password' => 'required|confirmed|min:6|max:32|has:letter,num',
				'phone' => 'numeric',
			],
			['password.has' => 'For increased security, please choose a password with a combination of lowercase and numbers',]


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
			//$newsletter = Input::get('userNewsletter'); // newsletter not currently captured

			if ($phone == '' && $area_code != '')
				return Response::json(['validation_failed' => 1, 'errors' => ['areacode'=>'Please enter you phone number']]);
			if ($phone != '' && $area_code == '')
				return Response::json(['validation_failed' => 1, 'errors' => ['areacode'=>'Please select a country']]);


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

        		
	            

				User::find($user->id)->makeUserDir();

				if(Request::ajax())
	        	{


					$user->save();

					Sentry::login($user, true);

					$redirectAfter = Input::get('redirect');
					//return Response::json(route('users.activate', array('display_name'=> $user->display_name)));

					if(isset($redirectAfter)) {
						//return Response::json($redirectAfter);
						return Response::json(['callback' => 'gotoUrl', 'url' => $redirectAfter]);
					}else{
						$activation_code = $user->getActivationCode();
				
						Event::fire('user.signup', array(
			            	'email' => $user->email, 
			            	'display_name' => $user->display_name, 
			                'activationCode' => $activation_code
			            ));
						//return Response::json(route('users.edit.tab', [$user->id ,'profile']));
						return Response::json(['callback' => 'gotoUrl', 'url' => route('users.edit.tab', [$user->id ,'profile'])]);
			
					}
					
					
					//return Redirect::route('users.edit', $user->display_name);
					//return Response::json($newsletter); // for testing
				}
			}
		}

		//return Input::all();
 
	}

	public function fb_login($redirect = null)
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

				User::find($user->id)->makeUserDir();
				
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

				if(isset($redirect) && $redirect != null )
				{
					if ($redirect == 'trainer') // Used when the 'i want to list classes' button is clicked in the register page
						return Redirect::route('trainers.create')->with('notification','you have successfully signed up with facebook, Your password has been emailed to you' );
					else // Used when logging in before hitting the checkout
						return Redirect::route($redirect);
				}
				else
				{
					return Redirect::route('users.edit.tab', [$user->id ,'profile'])->with('notification','you have successfully signed up with facebook, Your password has been emailed to you' );
				}

				//return Redirect::route('users.edit.tab', [$user->id ,'profile'])->with('notification','you have successfully signed up with facebook, Your password has been emailed to you' );
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

			    if ($redirect && $redirect != null)
			    {
					return Redirect::route($redirect);
				}
				elseif ($user->inGroup($trainerGroup))
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


				if(isset($redirect) && $redirect != null ) {

					return Response::json(route('trainers.create'));
				}else{
					return View::make('users.edit')->with('notification', 'you have successfully signed up with facebook. Your password has been emailed to you')->with('display_name', $user->display_name);
				}
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
			return Redirect::route('home')->with('errorNotification', 'Sorry we are experiencing technical difficulties, please try again or contact our technical support at support@evercise.com');
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

		JavaScript::put(array('initPut_user_edit' => json_encode(['selector' => '#user_edit']) ));
		JavaScript::put(array('initPut_send_invite' => json_encode(['selector' => '#send_invite']) ));
		JavaScript::put(array('initPut_password_change' => json_encode(['selector' => '#password_change']) ));
		JavaScript::put(array('initUsers' => 1 ));
		JavaScript::put(array('initToolTip' => 1 )); //Initialise tooltip JS.
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
		$dt = new DateTime();
		$before = $dt->sub(new DateInterval('P16Y'));
		$dateBefore=  $before->format('Y-m-d');
		$after = $dt->sub(new DateInterval('P104Y'));	
		$dateAfter=  $after->format('Y-m-d');


		$validator = Validator::make(
			Input::all(),
			array(
				'first_name' => 'required|max:15|min:3',
				'last_name' => 'required|max:15|min:3',
				'dob' => 'required|date_format:Y-m-d|after:'.$dateAfter.'|before:'.$dateBefore,
				//'email' => 'required|email',
				'phone' => 'numeric',
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
			//$email = Input::get('email');
			$gender = Input::get('gender');
			$newsletter = Input::get('userNewsletter');
			$image = Input::get('thumbFilename');
			$area_code = Input::get('areacode');
			$phone = Input::get('phone');

			if ($phone == '' && $area_code != '')
				return Response::json(['validation_failed' => 1, 'errors' => ['areacode'=>'Please enter you phone number']]);
			if ($phone != '' && $area_code == '')
				return Response::json(['validation_failed' => 1, 'errors' => ['areacode'=>'Please select a country']]);

			$this->user->update(array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'dob' => $dob,
				//'email' => $email,
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


			/* find out if user is a trainer or not */

			$trainerGroup = Sentry::findGroupByName('trainer');

			if ($this->user->inGroup($trainerGroup)) {
				$typeOfUser = 'trainers';
			}else{
				$typeOfUser = 'users';
			}
			
			return Response::json(['callback' => 'gotoUrl', 'url' => Request::root().'/'.$typeOfUser.'/'.$this->user->id.'/edit/profile']);
			//return Response::json(['callback' => 'gotoUrl', 'url' => Request::route('users.edit.tab', [$user->id ,'profile'])]);
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
	/*
	removed from current site but may return
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
	*/

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
				'old_password' => 'required',
				'new_password' => 'required|confirmed|min:6|max:32|has:letter,num',
			],
			['new_password.has' => 'For increased security, please choose a password with a combination of lowercase and numbers',]
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
			array(
				'email' => 'required|email',
				'password' => 'required|confirmed|min:6|max:32|has:letter,num',
			),
			['password.has' => 'The password must contain at least one number and can be a combination of lowercase letters and uppercase letters.',]
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
			    	$success = $user->attemptResetPassword($code, $password);

			    }
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    //return View::make('users.resetpassword')->with('message', 'Could not find user. Please check your email address');
				Session::flash('errorNotification', 'Sorry we are experiencing technical difficulties, please try again or contact our technical support at support@evercise.com');
		    		return Response::json(route('home'));
			}
			if ($success)
			{
				Event::fire('user.newpassword', array(
		        	'email' => $email
		        ));

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