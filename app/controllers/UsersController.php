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
				'userName' => 'required|max:20|min:5|unique:user',
				'userEmail' => 'required|email|unique:user',
				'userPassword' => 'required|confirmed',
			)
		);
		if($validator->fails()) {
			return Redirect::route('users.create')
					->withErrors($validator)
					->withInput();
		}
		else{
			//die("success!");
			$userName = Input::get('userName');
			$userEmail = Input::get('userEmail');
			$userPassword = Input::get('userPassword');
			$userPassword = Hash::make($userPassword);
			$userSex = Input::get('userSex');

			$code = str_random(60);

			$user = User::create(array(
				'userName' => $userName,
				'userEmail' => $userEmail,
				'userPassword' => $userPassword,
				'userSex' => $userSex
			));

			if($user) {
				//return Redirect::route('home');
			}


		}

		return Input::all();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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