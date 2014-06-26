<?php

class EvercisegroupsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( ! Sentry::check()) return Redirect::route('home')->with('notification', 'You have been logged out');

		$directory = $this->user->directory;
		$trainerGroup = Sentry::findGroupByName('trainer');

		if ($this->user->inGroup($trainerGroup))
		{
			$evercisegroups = Evercisegroup::with('evercisesession.sessionmembers')
			->with('futuresessions.sessionmembers')
			->with('pastsessions')
			->where('user_id', $this->user->id)->get();

			if ($evercisegroups->isEmpty()) {
				return View::make('evercisegroups.first_class');
			}else{
				$sessionDates = array();
				$totalMembers = array();
				$totalCapacity = array();
	    		$currentDate = new DateTime();

				foreach ($evercisegroups as $key => $group) {

					$sessionDates[$key] = $this->arrayDate($group->EverciseSession->lists('date_time', 'id'));
					//$totalCapacity[] =  $group->capacity * count($group['Evercisesession']);
					$capacity = 0;
					foreach ($group['Evercisesession'] as $k => $session) {
						if ( new DateTime($session->date_time) > $currentDate )
						{
							$totalMembers[$key][] = count($session->sessionmembers);
							$capacity += $group->capacity;
						}
					}
					$totalCapacity[] = $capacity;

				}


				$month = date("m");
				$year = date("Y");

				//JavaScript::put(array('initSlider_price' =>  json_encode(array('name'=>'price', 'min'=>0, 'max'=>99, 'step'=>0.50, 'value'=>1))));
				JavaScript::put(array('initSessions' => 1 )); // Initialise session JS.
				JavaScript::put(array('calendarSlide' => 1 )); // Initialise calendarSlide JS. priority 1 (0 is first)
				JavaScript::put(array('initEvercisegroups' => 1 )); // Initialise EverciseGroups JS.
				return View::make('evercisegroups.trainer_index')
						->with('evercisegroups' , $evercisegroups)
						->with('sessionDates' , $sessionDates )
						->with('totalMembers' , $totalMembers )
						->with('totalCapacity' , $totalCapacity )
						->with('year', $year)->with('month', $month)
						->with('directory', $directory);	
			}

		}
		else
		{
			return View::make('evercisegroups.index');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		if ( ! Sentry::check()) return Redirect::route('home')->with('notification', 'You have been logged out');

		$trainerGroup = Sentry::findGroupByName('trainer');

		if ($this->user->inGroup($trainerGroup))
		{
			$trainer = Trainer::where('user_id', $this->user->id)->get()->first();
		}

		else
		{
			return View::make('trainers.about');
		} 

		$categoriesDB = Category::all();

		$categories = array();
		$categoryDescriptions = array();
		foreach ($categoriesDB as $cat)
		{
		    $categories[$cat->id] = $cat->name;
		    $categoryDescriptions[$cat->id] = $cat->description;
		}

		JavaScript::put(array('initSlider_price' =>  json_encode(array('name'=>'price', 'min'=>0, 'max'=>120, 'step'=>0.50, 'value'=>1))));
		JavaScript::put(array('initSlider_duration' =>  json_encode(array('name'=>'duration', 'min'=>0, 'max'=>240, 'step'=>5, 'value'=>1))));
		JavaScript::put(array('initSlider_maxsize' =>  json_encode(array('name'=>'maxsize', 'min'=>0, 'max'=>200, 'step'=>1, 'value'=>1))));

        JavaScript::put(array('initImage' => json_encode(['ratio' => 'group_ratio']) )); // Initialise Users JS with Ratio string (defined in image.js)
		JavaScript::put(array('initEvercisegroups' => 1 )); // Initialise EverciseGroups JS.
		//JavaScript::put(array('MapWidgetloadScript' => 1 )); // Initialise map JS.
		JavaScript::put(array('categoryDescriptions' => json_encode($categoryDescriptions) ));
		return View::make('evercisegroups.create')->with('categories', $categories);
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
				'classname' => 'required|max:30|min:5',
				'description' => 'required|max:500|min:100',
				'category' => 'required',
				'duration' => 'required|numeric|between:20,240',
				'maxsize' => 'required|numeric|between:1,200',
				'price' => 'required|numeric|between:1,120',
				'image'	=> 'required',
				'gender'=> 'required',
				// 'lat' => 'required',
				// 'long' => 'required',
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

			$classname = Input::get('classname');
			$description = Input::get('description');
			$category = Input::get('category');
			$venue = 1;
			$duration = Input::get('duration');
			$maxsize = Input::get('maxsize');
			$price = Input::get('price');
			$image = Input::get('image');
			$gender = Input::get('gender');
			// $address = Input::get('address');
			// $city = Input::get('city');
			// $postcode = Input::get('postcode');
			// $lat = Input::get('lat');
			// $lng = Input::get('long');
			$venue = Input::get('venue');

			if ( ! Sentry::check()) return 'Not logged in';
			
			if (Trainer::where('user_id', $this->user->id)->count())
				$trainer = Trainer::where('user_id', $this->user->id)->get()->first();

			$evercisegroup = Evercisegroup::create(array(
				'name'=>$classname,
				'user_id'=>$this->user->id,
				'category_id'=>$category,
				'venue_id'=>$venue,
				'description'=>$description,
				'default_duration'=>$duration,
				'capacity'=>$maxsize,
				'default_price'=>$price,
				'image' => $image,
				'gender' => $gender,
				// 'address'=>$address,
				// 'town'=>$city,
				// 'postcode'=>$postcode,
				// 'lat'=>$lat,
				// 'lng' => $lng
				'venue_id' => $venue,
			));

			Trainerhistory::create(array('user_id'=> $this->user->id, 'type'=>'created_evercisegroup', 'display_name'=>$this->user->display_name, 'name'=>$evercisegroup->name));

			//return Response::json(route('home', array('display_name'=> $this->user->display_name)));
			//return Response::json($evercisegroup); // for testing
			//return View::make('evercisegroups.index');
			return Response::json(route('evercisegroups.index'));
		}
	}

	/**
	 * clone evercise group.
	 *
	 * @return Response
	 */
	public function cloneEG($id)
	{
		$evercisegroups = Evercisegroup::where('id', $id)->get()->first();
		
		return Redirect::route('evercisegroups.create')
				->with('name', $evercisegroups->name)
				->with('description', $evercisegroups->description)
				->with('category', $evercisegroups->category_id)
				->with('duration', $evercisegroups->default_duration)
				->with('maxsize', $evercisegroups->capacity)
				->with('price', $evercisegroups->default_price)
				->with('lat', $evercisegroups->lat)
				->with('lng', $evercisegroups->lng)
				->with('location', array('address' => $evercisegroups->address , 'city' => $evercisegroups->town , 'postCode' => $evercisegroups->postcode ) )
				->with('image_full', 'profiles/'.$this->user->directory.'/'. $evercisegroups->image)
				->with( 'image' , $evercisegroups->image );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//if (Sentry::check()) {

		 // return Redirect::route('home');

			$trainerGroup = Sentry::findGroupByName('trainer');

			if (Sentry::check() && $this->user->inGroup($trainerGroup))
			{
				$evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers.Users')->find($id);

				if ($evercisegroup->user_id == $this->user->id) {
					//$evercisegroup_id;
					if ( ! Sentry::check()) return 'Not logged in';

					$directory = $this->user->directory;
					$trainerGroup = Sentry::findGroupByName('trainer');
			
					if ($this->user->inGroup($trainerGroup))
					{
						$evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers.Users')
						->with('Evercisesession.Sessionpayment')
						->find($id);

						if ($evercisegroup['Evercisesession']->isEmpty())
						{
							//return Redirect::route('evercisegroups.index');

							return View::make('sessions.index')
								->with('evercisegroup' , $evercisegroup )
								->with('directory' , $directory)
								->with('members' , 0 );
						}
						else
						{
							$i = 0;
							$totalSessionMembers = 0;
							$totalCapacity = 0;
							$averageSessionMembers = 0;
							$averageCapacity = 0;

									$members = [];
							foreach ($evercisegroup->evercisesession as $key => $value) {
								$totalCapacity = $totalCapacity + $evercisegroup->capacity;
								$members[$key] = count($value['Sessionmembers']); // Count those members
								$totalSessionMembers= $totalSessionMembers + $members[$key];
								++$i;
							}

							$averageSessionMembers = round($totalSessionMembers/$i, 1);
							$averageSessionMembers = round($totalSessionMembers/$i, 1);
							$averageCapacity = round($totalCapacity/$i, 1);

							//return '<h1>'. $averageCapacity . '</h1>';

							JavaScript::put(array('mailAll' => 1 ));
							JavaScript::put(array('initSessionListDropdown' => 1 )); // Initialise session list dropdown JS.
							JavaScript::put(array('initEvercisegroupsShow' => 1 )); // Initialise buttons

							return View::make('sessions.index')
								->with('evercisegroup' , $evercisegroup )
								->with('directory' , $directory)
								->with('totalSessionMembers' , $totalSessionMembers)
								->with('totalCapacity' , $totalCapacity)
								->with('averageSessionMembers' , $averageSessionMembers)
								->with('averageCapacity' , $averageCapacity)
								->with('members' , $members);
						}
					}
					else
					{
						return Redirect::route('home');
					}
				}

				return View::make('evercisegroups.show')->with('evercisegroup',$evercisegroup); // change to trainer show view
			}
		//}
		else
		{
			$evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers')->find($id);

			$userTrainer = User::with('Trainer')->find($evercisegroup->user_id);


			$trainerDetails = $userTrainer->trainer;

			$trainer=Trainer::with('user')
					->with('speciality')
					->where('user_id', $evercisegroup->user_id)
					->first();

			$members = [];
			$membersIds = [];
			$memberAllIds = [];
			$memberUsers = [];
			foreach ($evercisegroup->evercisesession as $key => $evercisesession) {
				$members[$key] = count($evercisesession['sessionmembers']); // Count those members
				foreach ($evercisesession['sessionmembers'] as $k => $sessionmember) {
					$membersIds[$key][] =  $sessionmember->user_id;	
					$memberAllIds[]	 = 	$sessionmember->user_id;	
					//$memberUsers[] = $sessionmember->users;

				}
			}

			if (!empty($memberAllIds)) {
				$memberUsers = User::whereIn('id', $memberAllIds)->distinct()->get();
			}
			


			$venue = Venue::with('facilities')->find($evercisegroup->venue_id);

			$ratings = Rating::with('user')->where('evercisegroup_id', $evercisegroup->id)->get();

			JavaScript::put(array('initJoinEvercisegroup' => 1 ));
			JavaScript::put(array('initSwitchView' => 1 ));
			JavaScript::put(array('initScrollAnchor' => 1 ));
			JavaScript::put(array('initStickHeader' => 1 ));

			JavaScript::put(array('MapWidgetloadScript' => 1 )); // Initialise map JS.

			return View::make('evercisegroups.show')
						->with('evercisegroup',$evercisegroup)
						->with('trainer',$trainer)
						->with('members' , $members)
						->with('membersIds' , $membersIds)
						->with('memberUsers' , $memberUsers)
						->with('venue' , $venue)
						->with('ratings' , $ratings)
						//->with('memberUsers' , $memberUsers)
						//->with('trainer',$trainerDetails)
						;
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
		echo('edit');
		exit;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		echo('update');
		exit;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Route
	 */
	public function destroy($id)
	{

		$evercisegroup = Evercisegroup::with('evercisesession.sessionmembers')->find($id);

		// Check user id against group
		if ($this->user->id == $evercisegroup->user_id)
		{
			// Only delete if there's no members joined
			if (count($evercisegroup->sessionmember)==0)
			{
				// If Evercisegroup contains Evercisesessions, delete them all.
				if (!$evercisegroup['Evercisesession']->isEmpty())
				{
					foreach ($evercisegroup['Evercisesession'] as $value) {
						$value->delete();
					}
				}
				
				// Now, delete actual Evercisegroup too.
				$evercisegroupForDeletion = Evercisegroup::find($id);
				$evercisegroupForDeletion->delete();

				Trainerhistory::create(array('user_id'=> $this->user->id, 'type'=>'deleted_evercisegroup', 'display_name'=>$this->user->display_name, 'name'=>$evercisegroup->name));
			}
		}
		return Route('evercisegroups.index');
	}


	/**
	 * Bring up delete view in window
	 *
	 * @param  int  $id
	 * @return Route
	 */
	public function deleteEG($id)
	{

		$evercisegroup = Evercisegroup::with('evercisesession.sessionmembers')->find($id);

		if (count($evercisegroup->sessionmember))
		{
			return View::make('evercisegroups.delete')->with('id','$id')->with('name',$evercisegroup->name)->with('evercisegroup',$evercisegroup)->with('deleteable',3);
		}
		else
		{
			if ($evercisegroup->evercisesession->isEmpty())
			{
				//return $evercisegroup;
				return View::make('evercisegroups.delete')->with('id',$id)->with('name',$evercisegroup->name)->with('evercisegroup',$evercisegroup)->with('deleteable',1);
			}
			else
			{
				//return $evercisegroup;
				return View::make('evercisegroups.delete')->with('id',$id)->with('name',$evercisegroup->name)->with('evercisegroup',$evercisegroup)->with('deleteable',2);
			}
		}
		 return Redirect::route('home');
		//return 'delete '.$id;
	}

	/**
	 * query eg's based on location
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function searchEg($id)
	{
		$query = Input::get('location');
		$radius = Input::get('radius');
		$category = Input::get('category');

        $geocoder = new \Geocoder\Geocoder();
        $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();

        $geocoder->registerProvider(new \Geocoder\Provider\GoogleMapsProvider($adapter));

        try {
            $geocode = $geocoder->geocode($query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }   

        $coordToGeohash = Geotools::coordinate($geocode->getCoordinates());

        $encoded = Geotools::geohash()->encode($coordToGeohash, 3);

        $boundingBox = $encoded->getBoundingBox();

        //return var_dump($boundingBox);

        $haversine = '(3959 * acos(cos(radians(' . $geocode->getLatitude() . ')) * cos(radians(lat)) * cos(radians(lng) - radians(' . $geocode->getLongitude() . ')) + sin(radians(' . $geocode->getLatitude() . ')) * sin(radians(lat))))';

        $evercisegroups= Evercisegroup::has('futuresessions')
        ->has('confirmed')
		->with(array('venue' =>function($query) use (&$haversine,&$radius)
        {

        	$query->select( array('*', DB::raw($haversine . ' as distance')) )
        		  ->having('distance', '<', $radius);


        }))
        ->with('user')
		->where('category_id' , $category)
		->get();



       /* $places = Venue::with(array('evercisegroup' =>function($query) use (&$category)
        {

        	$query->where('category_id' , $category);

        }))*/
/*
         $places = Venue::whereHas('evercisegroup' , function($query) use (&$category)
        {

        	$query->where('category_id' , $category);

        })
         ->with('evercisesessions')
        /*->whereHas('evercisesessions' , function($query)
        {
        	$query->where('date_time', '>=',  DB::raw('UNIX_TIMESTAMP(NOW())'));
        })*/
        //->with('evercisegroup.Evercisesession.Sessionmembers')
        //->with('evercisegroup.user')
/*
       	->select( array('*', DB::raw($haversine . ' as distance')) )
	    ->whereBetween('lat', array(0,100))
	    //->where('category_id' , $category)
	    ->orderBy('distance', 'ASC')
	    ->having('distance', '<', $radius)	    
	    ->get(); 
*/
	    //return var_dump($places);

	    //todo swap code above for below then change loops in view

	    /*
	    $places= Evercisegroup::with('evercisesession')
		->with(array('venue' =>function($query) use (&$haversine,&$radius)
        {

        	$query->select( array('*', DB::raw($haversine . ' as distance')) )
        		  ->having('distance', '<', $radius);


        }))
		->where('category_id' , $category)
		->get();

		*/



	    //$evercisegroups = [];  
	    $evercisegroup_ids = [];  
	    $stars = [];

	    foreach ($evercisegroups as $key => $evercisegroup) {
	    		$evercisegroup_ids[] = $evercisegroup->id;	    	
	    };

	    //return var_dump($evercisegroups);
	    //exit;

	    //return var_dump($evercisegroup_ids);

	    if (!empty($evercisegroup_ids)) {
	    	$ratings = Rating::whereIn('evercisegroup_id', $evercisegroup_ids)->get();

		    foreach ($ratings as $key => $rating) {
		    	$stars[$rating->evercisegroup_id][] = $rating->stars;
		    }

	    }

	   // JavaScript::put(array('classes' => json_encode($places) ));
	    JavaScript::put(array('MapWidgetloadScript' =>  json_encode(array('discover'=> true))));
	    JavaScript::put(array('initSwitchView' => 1 ));
	    JavaScript::put(array('InitSearchForm' => 1 ));

	    return View::make('evercisegroups.search')
	    		->with('places' , $evercisegroups)
	    		->with('stars' , $stars)
	    		->with('evercisegroups' , $evercisegroups);
	    		//->with('members' , $members);
	}	

}