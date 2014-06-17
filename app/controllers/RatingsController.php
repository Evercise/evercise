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

			$groupname = Evercisegroup::find($evercisegroup_id)->pluck('name');
			$groupname = Evercisegroup::find($evercisegroup_id)->pluck('name');
			$date_time = Evercisesession::find($session_id)->pluck('date_time');
			$timestamp = strtotime($date_time);
			$niceTime = date('h:ia', $timestamp);
			$niceDate = date('dS F Y', $timestamp);
		    Trainerhistory::create(array('user_id'=> $user_id, 'type'=>'rated_session', 'display_name'=>$this->user->display_name, 'name'=>$groupname, 'time'=>$niceTime, 'date'=>$niceDate));

		}

		return Response::json(['callback' => 'refreshpage' ,'message' => $session_id]);
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