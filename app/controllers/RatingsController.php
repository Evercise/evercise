<?php

class RatingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		// TODO - add security (check if user is a member of the session, and the session is in the past)

		$validator = Validator::make(
			Input::all(),
			array(
				'feedback_text' => 'required',
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
	        	return Redirect::route('evercisegroups.create')
					->withErrors($validator)
					->withInput();
	        }
		}
		else
		{
			$user_id = Input::get('user_id');
			$sessionmember_id = Input::get('sessionmember_id');
			$session_id = Input::get('session_id');
			$evercisegroup_id = Input::get('evercisegroup_id');
			$user_created_id = $this->user->id;
			$stars = Input::get('stars');
			$comment = Input::get('feedback_text');

			Rating::create([
				'user_id' => $user_id,
				'sessionmember_id' => $sessionmember_id,
				'session_id' => $session_id,
				'evercisegroup_id' => $evercisegroup_id,
				'user_created_id' => $user_created_id,
				'stars' => $stars,
				'comment' => $comment
			]);
		}

		return Response::json(['message' => $session_id]);
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