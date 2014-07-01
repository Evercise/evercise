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

		//$user = Sentry::getUser();
		$trainerGroup = Sentry::findGroupByName('trainer');
		if ($this->user->inGroup($trainerGroup))
		{
			return Redirect::route('trainers.edit', $this->user->id);
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
		JavaScript::put(array('initTrainerTitles' => json_encode(['titles' =>$titles]) )); // Initialise title swap Trainer JS.
		JavaScript::put(array('initImage' => json_encode(['ratio' => 'user_ratio']) )); // Initialise Users JS with Ratio string (defined in image.js)
		return View::make('trainers.create')
			->with('disciplines', $disciplines)
			->with('gyms', $gyms);


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
				'thumbFilename' => 'required',
				'phone' => 'required',
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
			$image = Input::get('thumbFilename');
			$website = Input::get('website');
			$area_code = Input::get('areacode');
			$phone = Input::get('phone');
			$speciality = DB::table('specialities')->where('name', $discipline)->where('titles', $title)->pluck('id');
			$trainer = Trainer::create(['user_id'=>$user->id, 'bio'=>$bio, 'specialities_id'=>$speciality, 'website'=>$website]);

			$wallet = Wallet::create(['user_id'=>$user->id, 'amount'=>0, 'previous_amount'=>0]);

			// update user image

			$user->image = $image;
			$user->area_code = $area_code;
			$user->phone = $phone;


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
			return Response::json(route('trainers.edit', array('id'=> $user->id)));
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, $tab=0)
	{
		if (!Sentry::check()) return Redirect::route('home')->with('notification', 'You have been logged out');
		$trainer = Trainer::where('user_id' , $this->user->id)
				->with('speciality')
				->first();
		$speciality = Speciality::find($trainer->specialities_id);

		JavaScript::put(array('initDashboardPanel' => 1 )); // Initialise dashboard panls JS.
		JavaScript::put(array('initPut' => 1 )); // Initialise put ajax function JS.

		JavaScript::put(array('selectTab' => $tab ));

		return View::make('trainers.edit')
			->with('trainer', $trainer)
			->with('speciality', $speciality);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//$userTrainer = User::has('Trainer')->find($id);
		//$trainer = Trainer::where('user_id' ,$userTrainer->id)->first();

		//$speciality = Speciality::where('id', $trainer['Trainer'][0]['specialities_id'])->pluck(DB::raw("CONCAT(name, ' ', titles)")); // specialities_id is a extra layer down from trainer

		$trainer=Trainer::with('user')
					->with('speciality')
					->where('user_id', $id)
					->first();

		$evercisegroups = Evercisegroup::with('evercisesession.sessionmembers')
			->with('venue')
			->where('user_id', $trainer->user->id)->get();

		$stars = [];
		$totalStars = 0;
		$evercisegroup_ids = [];

		foreach ($evercisegroups as $key => $evercisegroup) {
			$evercisegroup_ids[] = $evercisegroup->id;
		}

		if (!empty($evercisegroup_ids)) {
	    	$ratings = Rating::with('user')->whereIn('evercisegroup_id', $evercisegroup_ids)->get();

		    foreach ($ratings as $key => $rating) {
		    	$stars[$rating->evercisegroup_id][] = $rating->stars;
		    	$totalStars = $totalStars + $rating->stars;
		    }

	    }
		

		return View::make('trainers.show')
				//->with('userTrainer', $userTrainer)
				->with('trainer', $trainer)
				->with('evercisegroups', $evercisegroups)
				->with('stars', $stars)
				->with('totalStars', $totalStars)
				->with('ratings', $ratings);
				//->with('speciality', $speciality);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$validator = Validator::make(
			Input::all(),
			array(
				'bio' => 'required|max:500|min:50',
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
	        	return Redirect::route('trainers.edit')
					->withErrors($validator)
					->withInput();
	        }
		}
		else{
			// Actually update the trainer record 

			$discipline = Input::get('discipline');
			$title = Input::get('title');
			$bio = Input::get('bio');
			$website = Input::get('website');

			$trainer = Trainer::find($id);

			if ($this->user->id != $trainer->user_id) return Response::json(['callback' => 'fail']);

			$speciality = Speciality::where('name', $discipline)->where('titles', $title)->first();
			//$speciality = DB::table('specialities')->where('name', $discipline)->where('titles', $title)->pluck('id');

			$trainer->update(array(
				'bio' => $bio,
				'website' => $website,
				'specialities_id' => $speciality->id, 
			));

			$result = array(
		            'sp' =>  $speciality,
		            'callback' => 'successAndRefresh'
		         );	

			return Response::json($result);

		}
		//return Response::json($result);
		//return View::make('users.edit');
	}
}