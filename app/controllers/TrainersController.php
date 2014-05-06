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
		   return View::make('trainers.about')->with('status','logged-out')->with('redirect_after_login', true); 
		}
		else
		{
			$professions = Speciality::all();
			$disciplines = array();
			$titles = array();
			$disciplineNum = 0;
			foreach ($professions as $prof)
			{
			    if (!isset($titles[$prof->name]))
			    {
			    	$disciplines[$prof->name] = $prof->name;
			    	$titles[$prof->name] = array($prof->titles);
			    }
			   	else array_push($titles[$prof->name], $prof->titles);
			}

			JavaScript::put(array('titles' => json_encode($titles)));

			return View::make('trainers.create')->with('disciplines', $disciplines);
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

			$speciality = DB::table('specialities')->where('name', $discipline)->where('titles', $title)->pluck('id');
			$trainer = Trainer::create(array('user_id'=>$user->id, 'bio'=>$bio, 'profession'=>$speciality, 'website'=>$website));

			//return Response::json(route('home', array('display_name'=> $user->display_name)));
			return Response::json($bio); // for testing
		}

	}
}