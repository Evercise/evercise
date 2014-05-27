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

		$user = Sentry::getUser();
		$trainerGroup = Sentry::findGroupByName('trainer');
		if ($user->inGroup($trainerGroup))
		{
			return 'you are already a trainer, man';
		}

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

		JavaScript::put(array('initCreateTrainer' => 1 )); // Initialise Create Trainer JS.
		JavaScript::put(array('titles' => json_encode($titles), ));
		return View::make('trainers.create')->with('disciplines', $disciplines)->with('gyms', $gyms);


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
				'title' => 'required',
				'bio' => 'required|max:500|min:50',
				'image' => 'required',
				'website' => 'sometimes|active_url',
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
			$image = Input::get('image');
			$website = Input::get('website');

			$speciality = DB::table('specialities')->where('name', $discipline)->where('titles', $title)->pluck('id');
			$trainer = Trainer::create(array('user_id'=>$user->id, 'bio'=>$bio, 'profession'=>$speciality, 'website'=>$website));

			// update user image

			$user->image = $image;

			$user->save();

			// add to trainer group

			$userGroup = Sentry::findGroupById(3);
			$user->addGroup($userGroup);

			// welcome email

			Event::fire('user.upgrade', array(
            	'email' => $user->email, 
            	'display_name' => $user->display_name
            ));

			//respond
			return Response::json(route('trainers.edit', array('display_name'=> $user->display_name)));
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('trainers.edit');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$trainer = User::with('Trainer')->find($id);

		return View::make('trainers.show')->with('trainer', $trainer);
	}
}