<?php

class SessionsController extends \BaseController {

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
		// NOTE - The view is set up in a view composer, not here. (app/composers.php)

		return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// echo 'Sessions store';
		// exit;

		$validator = Validator::make(
			Input::all(),
			array(
				's-evercisegroupId' => 'required',
				's-year' => 'required',
				's-month' => 'required',
				's-date' => 'required',
				's-time-hour' => 'required',
				's-time-minute' => 'required',
				'price' => 'required',
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
		else {

			$evercisegroup = Input::get('s-evercisegroupId');
			$year = Input::get('s-year');
			$month = Input::get('s-month');
			$date = Input::get('s-date');
			$hour = Input::get('s-time-hour');
			$minute = Input::get('s-time-minute');
			$price = Input::get('price');
			//$customurl = Input::get('customurl');

			$time = $hour.'-'.$minute.'-00';

			$date_time = $year.'-'.$month.'-'.$date.' '.$time;

			if ( ! Sentry::check()) return 'Not logged in';

			$user = Sentry::getUser();
			
			if (Trainer::where('user_id', $user->id)->count())
				$trainer = Trainer::where('user_id', $user->id)->get()->first();

			$session = EverciseSession::create(array(
				'evercisegroup_id'=>$evercisegroup,
				'date_time'=>$date_time,
				'price'=>$price,
			));

			//return Response::json(route('home', array('display_name'=> $user->display_name)));
			return Response::json($evercisegroup); // for testing
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