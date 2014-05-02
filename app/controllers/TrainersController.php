<?php

class TrainersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('trainers.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if ( ! Sentry::check())
		{
		    // User is not logged in, or is not activated
		    return "Not logged in"; 
		}
		else
		{
			$specialities = Speciality::all();
			$disciplines = array();
			$titles = array();
			foreach ($specialities as $sp)
			{
			    if (!isset($titles[$sp->name]))
			    {
			    	$disciplines[$sp->name] = $sp->name;
			    	$titles[$sp->name] = array($sp->titles);
			    }
			   	else array_push($titles[$sp->name], $sp->titles);
			}

			$gyms_data = Gym::all();
			$gyms = array();
			foreach ($gyms_data as $gym)
			{
			    $gyms[$gym->id] = $gym->name;
			}

			// http://image.intervention.io/methods/crop
			// http://odyniec.net/projects/imgareaselect

			JavaScript::put(array('titles' => json_encode($titles), ));
			return View::make('trainers.create')->with('disciplines', $disciplines)->with('gyms', $gyms);
		}

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
				'bio' => 'required',
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
	        	return Redirect::route('trainers.create')
					->withErrors($validator)
					->withInput();
	        }
		}
		else {
			$user = Sentry::getUser();

			$discipline = Input::get('discipline');
			$title = Input::get('title');
			$bio = Input::get('bio');
			$website = Input::get('website');
			$gym = Input::get('gym');

			$speciality = DB::table('specialities')->where('name', $discipline)->where('titles', $title)->pluck('id');
			$trainer = Trainer::create(array('user_id'=>$user->id, 'bio'=>$bio, 'profession'=>$speciality, 'website'=>$website));

			//return Response::json(route('home', array('display_name'=> $user->display_name)));
			return Response::json($bio); // for testing
		}

	}
}