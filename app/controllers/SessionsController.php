<?php

class SessionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($evercisegroup_id = '')
	{
		//$evercisegroup_id;
		if ( ! Sentry::check()) return 'Not logged in';
		$user = Sentry::getUser();

		$directory = $user->directory;
		$trainerGroup = Sentry::findGroupByName('trainer');
		
		if ($user->inGroup($trainerGroup))
		{
			$Evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers.Users')->find($evercisegroup_id);

			if ($Evercisegroup['Evercisesession']->isEmpty()) {
				return Redirect::route('evercisegroups.index');
			}
			else
			{
				return View::make('sessions.index')->with('evercisegroup' , $Evercisegroup )->with('directory' , $directory);
			}		
		}
		else
		{
			return Redirect::route('home');
		}

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// The slider is initialised in JS from the view, as the document.ready has already run


        $year = Input::get('year');
        $month = Input::get('month');
        $date = Input::get('date');
        $id = Input::get('evercisegroupId');

		$evercisegroup = Evercisegroup::where('id', $id)->first();

		$duration = $evercisegroup->default_duration;
		$price = $evercisegroup->default_price;
		$name = $evercisegroup->name;



		return View::make('sessions.create')->with('year',$year)->with('month',$month)->with('date',$date)->with('id',$id)->with('duration',$duration)->with('price',$price)->with('name',$name);
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
				's-price' => 'required',
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

			$evercisegroupId = Input::get('s-evercisegroupId');
			$year = Input::get('s-year');
			$month = Input::get('s-month');
			$date = Input::get('s-date');
			$hour = Input::get('s-time-hour');
			$minute = Input::get('s-time-minute');
			$price = Input::get('s-price');
			//$customurl = Input::get('customurl');

			$time = $hour.':'.$minute.':00';

			$date_time = $year.'-'.$month.'-'.$date.' '.$time;

			if ( ! Sentry::check()) return 'Not logged in';

			$user = Sentry::getUser();
			
			if (Trainer::where('user_id', $user->id)->count())
				$trainer = Trainer::where('user_id', $user->id)->get()->first();

			$session = EverciseSession::create(array(
				'evercisegroup_id'=>$evercisegroupId,
				'date_time'=>$date_time,
				'price'=>$price,
			));

			$evercisegroup = Evercisegroup::where('id', $evercisegroupId)->firstOrFail();

			$timestamp = strtotime($date_time);
			$niceTime = date('h:ia', $timestamp);
			$niceDate = date('dS F Y', $timestamp);
			Trainerhistory::create(array('user_id'=> $user->id, 'display_name'=>$user->display_name, 'name'=>$evercisegroup->name, 'time'=>$niceTime, 'date'=>$niceDate));

			return Response::json(route('evercisegroups.index'));
			//return Response::json($evercisegroup); // for testing
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
		return 'Show';
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return 'Edit';
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return 'Update';
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return 'Destroy';
	}

}