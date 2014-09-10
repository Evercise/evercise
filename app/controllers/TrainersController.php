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
		return    View::make('trainers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $result = Trainer::createTrainerRecord(Input::all());

        if($result == 'saved')
        {
            return Response::json(
                [
                    'callback' => 'gotoUrl',
                    'url' => route('evercisegroups.index')
                ]
            );
        }
        else
        {
            return Response::json(
                [
                    'callback' => 'validationFailed',
                    'errors' => $result
                ]
            );
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
				//->with('speciality')
				->first();
		


		return View::make('trainers.edit')
			->with('trainer', $trainer)
			->with('profession', $trainer->profession)
			->with('tab', $tab);
			//->with('speciality', $speciality);
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