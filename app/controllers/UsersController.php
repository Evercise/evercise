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

/*			$data['user'] = $user;
			Mail::send('emails.auth.welcome', $data, function($message) use ($user)
			{
			    $message->to('example@example.hu', $user->username)->subject('Account');
			})
*/
			if($user) {
				if(Request::ajax())
	        	{
					Event::fire('user.signup', array(
		            	'email' => $user->email, 
		            	'display_name' => $user->display_name, 
		                'activationCode' => $activation_code
		            ));

					if($this->makeUserDir($user))
					{
    					return Response::json(route('auth.login'));
    				}		
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

				Event::fire('user.signup', array(
		        	'email' => $user->email, 
		        	'display_name' => $user->display_name, 
		            'password' => $password
		        ));

				$this->makeUserDir($user);
				
				$path = public_path().'/profiles/'.date('Y-m');
/*				$url = 'http://tristanallen.co.uk/tristan_allen.jpg';
				$contents = File::get($url);//'https://graph.facebook.com/'.$me["id"].'/picture?type=large');
				File::put($path.'/'.$user->id.'_'.$user->display_name.'/facebook-image.jpg', $contents);
*/

				$url = 'http://graph.facebook.com/' . $me["username"] . '/picture?type=large';
				//$url = 'http://tristanallen.co.uk/tristan_allen.jpg';
				//$url = 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash3/t1.0-1/c53.45.557.557/s200x200/936888_10152789400300290_1726812964_n.jpg';
				/*$file_handler = fopen($path.'/'.$user->id.'_'.$user->display_name.'/facebook-image.jpg', 'w');
				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_FILE, $file_handler);
				curl_setopt($curl, CURLOPT_HEADER, 0);
				curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				curl_exec($curl);

				curl_close($curl);
				fclose($file_handler);*/


				$img = file_get_contents($url);
				file_put_contents($path.'/'.$user->id.'_'.$user->display_name.'/facebook-image.jpg', $img);
			

				return View::make('users.show');
				

			}
	    }

		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$user = Sentry::findUserByLogin($me['email']);
		    Sentry::login($user,false);
		}

	}

	public function makeUserDir($user)
	{

        $path = public_path().'/profiles/'.date('Y-m');

        if(!file_exists($path)){

        	File::makeDirectory($path);
        }

        File::makeDirectory($path.'/'.$user->id.'_'.$user->display_name);

        $user->directory = date('Y-m').'/'.$user->id.'_'.$user->display_name;

        if ($user->save())
		{
			return true;
		}
		else
		{
			return false;
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
		$user = Sentry::findUserByActivationCode($code);

		if ($user->attemptActivation($code))
	    {
	        // User activation passed
			return View::make('users.edit')->with('activation','passed')->with('display_name', $display_name);
	    }
	    else
	    {
	        // User activation failed
			return View::make('users.edit')->with('activation','failed')->with('display_name', $display_name);
	    }

	}

}