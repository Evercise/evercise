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
			//$password = Hash::make($password);
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
        			$result = $user;

					Event::fire('user.signup', array(
		            	'email' => $result->email, 
		            	'display_name' => $result->display_name, 
		                'activationCode' => $activation_code
		            ));

					return Response::json($result);
				}else{
					return Redirect::route('home');
				}
			}
		}

		//return Input::all();
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