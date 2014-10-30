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

		// http://image.intervention.io/methods/crop
		// http://odyniec.net/projects/imgareaselect

		return View::make('trainers.create')
			->with('disciplines', $disciplines);


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
				//'title' => 'required',
				'bio' => 'required|max:500|min:50',
				'image' => 'required',
				'phone' => 'required|numeric',
				'website' => 'sometimes',
				'profession' => 'required|max:50|min:2',
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

			$bio = Input::get('bio');
			$image = Input::get('image');
			$website = Input::get('website');
			$area_code = Input::get('areacode');
			$phone = Input::get('phone');
			//$discipline = Input::get('discipline');
			//$title = Input::get('title');
			//$speciality = DB::table('specialities')->where('name', $discipline)->where('titles', $title)->pluck('id');
			$profession = Input::get('profession');

			if ($phone == '' && $area_code != '')
				return Response::json(['validation_failed' => 1, 'errors' => ['areacode'=>'Please enter you phone number']]);
			if ($phone != '' && $area_code == '')
				return Response::json(['validation_failed' => 1, 'errors' => ['areacode'=>'Please select a country']]);


			$trainer = Trainer::createOrFail(['user_id'=>$user->id, 'bio'=>$bio, 'website'=>$website, 'profession'=>$profession]);

			// Duck out if record already exists
			if (!$trainer) return Response::json(['callback' => 'gotoUrl', 'url' =>  route('trainers.edit.tab', ['id'=> $user->id, 'evercoins'])]);

			// Use firstOrCreate just incase to make sure no duplicates are made
			$wallet = Wallet::firstOrCreate(['user_id'=>$user->id, 'balance'=>0, 'previous_balance'=>0]);

			// update user image

			$user->image = $image;
			$user->area_code = $area_code;
			$user->phone = $phone;
			$user->save();

			// add to trainer group

			$userGroup = Sentry::findGroupById(3);
			$user->addGroup($userGroup);

			// welcome email

			Event::fire('user.confirm', array(
            	'email' => $user->email, 
            	'display_name' => $user->display_name
            ));

            Event::fire('trainer.registered', [$user]);

			return Response::json(['callback' => 'gotoUrl', 'url' => route('evercisegroups.index')]);
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

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$trainer=Trainer::with('user')
					//->with('speciality')
					->where('user_id', $id)
					->first();

		// check if trainer has classes else redirect them home
		try{
			$evercisegroups = Evercisegroup::has('evercisesession')
			->with('evercisesession')
			->with('venue')
			->where('user_id', $trainer->user->id)->get();
		}catch(Exception $e){
			return Redirect::route('home')->with('notification', 'this trainer does not exist');
		}
		

		$stars = [];
		$totalStars = 0;
		$evercisegroup_ids = [];

		foreach ($evercisegroups as $key => $evercisegroup) {
			$evercisegroup_ids[] = $evercisegroup->id;
		}

		if (!empty($evercisegroup_ids)) {
	    	$ratings = Rating::with('rator')->whereIn('evercisegroup_id', $evercisegroup_ids)->orderBy('created_at')->get();

		    foreach ($ratings as $key => $rating) {
		    	$stars[$rating->evercisegroup_id][] = $rating->stars;
		    	$totalStars = $totalStars + $rating->stars;
		    }
	    }
	    else
	    {
	    	$ratings = [];
	    }
	    
		return View::make('trainers.show')
				->with('trainer', $trainer)
				->with('evercisegroups', $evercisegroups)
				->with('stars', $stars)
				->with('totalStars', $totalStars)
				->with('ratings', $ratings);
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
				'profession' => 'required|max:50|min:5',
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

			$bio = Input::get('bio');
			$website = Input::get('website');
			$profession = Input::get('profession');

			$trainer = Trainer::find($id);

			if ($this->user->id != $trainer->user_id) return Response::json(['callback' => 'fail']);

			$trainer->update(array(
				'bio' => $bio,
				'website' => $website,
				'profession' => $profession,
				//'specialities_id' => $speciality->id, 
			));

			$result = array(
		            'callback' => 'gotoUrl',
		            'url' => '/trainers/2/edit/trainer'
		         );

            Event::fire('trainer.editTrainerDetails', [$this->user]);

			return Response::json($result);

		}
	}

	public function trainerSignup()
	{
		Session::put('redirectAfter', 'trainer/create');

		return Redirect::to('users/create');
	}
}