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

		$validator = Validator::make(
			Input::all(),
			array(
				'sessionmember_id' => 'unique:ratings,sessionmember_id',
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

			$sessionmember = Sessionmember::find($sessionmember_id);
			$group = Evercisegroup::find($evercisegroup_id);
			$session = Evercisesession::find($session_id);

			// Check integrity of id's
			if (!$sessionmember)
				return Response::json(['callback' => 'sendhome' ,'message' => 'no sessionmember']);
			elseif ( $sessionmember->user_id != $user_created_id || $user_id != $group->user_id || $sessionmember->evercisesession_id != $session_id || $session->evercisegroup_id != $evercisegroup_id)
				return Response::json(['callback' => 'sendhome' ,'message' => 'ids do not match']);
			// Check group is in past
			elseif (strtotime($session->date_time) >= strtotime( date('Y-m-d H:i:s') ) )
				return Response::json(['callback' => 'sendhome' ,'message' => 'Session is in the future']);

			Rating::create([
				'user_id' => $user_id,
				'sessionmember_id' => $sessionmember_id,
				'session_id' => $session_id,
				'evercisegroup_id' => $evercisegroup_id,
				'user_created_id' => $user_created_id,
				'stars' => $stars,
				'comment' => $comment
			]);


			$timestamp = strtotime($session->date_time);
			$niceTime = date('h:ia', $timestamp);
			$niceDate = date('dS F Y', $timestamp);
		    Trainerhistory::create(array('user_id'=> $user_id, 'type'=>'rated_session', 'display_name'=>$this->user->display_name, 'name'=>$group->name, 'time'=>$niceTime, 'date'=>$niceDate));
		    Milestone::where('user_id', $this->user->id)->first()->add('review');

		}

		return Response::json(['callback' => 'refreshpage' ,'notification' => $session_id]);
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