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
				'displayName' => 'required|max:20|min:5|unique:users',
				'first_name' => 'required|max:50|min:2',
				'last_name' => 'required|max:50|min:2',
				'email' => 'required|email|unique:users',
				'password' => 'required|confirmed',
			)
		);
		if($validator->fails()) {
			if(Request::ajax())
	        { 
	        	$response_values = array(
		            'validation_failed' => 1,
		            'errors' =>  $validator->errors()->toArray()
		         );	

				return Response::json($response_values);
	        }else{
	        	return Redirect::route('users.edit')
					->withErrors($validator)
					->withInput();
	        }			
		}
		else{
			die("success!");
			$displayName = Input::get('displayName');
			$first_name = Input::get('first_name');
			$last_name = Input::get('last_name');
			$email = Input::get('email');
			$password = Input::get('password');
			$password = Hash::make($userPassword);
			$gender = Input::get('gender');

			
			
			$code = str_random(60);

			$user = User::create(array(
				'displayName' => $displayName,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
				'password' => $password,
				'gender' => $gender
			));

			if($user) {
				if(Request::ajax())
        		{		 
					$response_values = array(
						'validation_failed' => 0
					);
					return Response::json($response_values);
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
		//
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

}