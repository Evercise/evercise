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
			->with('venue')
			->where('user_id', $this->user->id)->get();

			if ($evercisegroups->isEmpty()) {
				return View::make('evercisegroups.first_class');
			}else{
				$sessionDates = array();
				$totalMembers = array();
				$totalCapacity = array();
	    		$currentDate = new DateTime();

	    		$evercisegroup_ids = [];  
			    $stars = [];

				foreach ($evercisegroups as $key => $group) {

					$sessionDates[$key] = Functions::arrayDate($group->EverciseSession->lists('date_time', 'id'));
					//$totalCapacity[] =  $group->capacity * count($group['Evercisesession']);
					$capacity = 0;
					$evercisegroup_ids[] = $group->id;
					foreach ($group['Evercisesession'] as $k => $session) {
						if ( new DateTime($session->date_time) > $currentDate )
						{
							$totalMembers[$key][] = count($session->sessionmembers);
							$capacity += $group->capacity;
						}
					}
					$totalCapacity[] = $capacity;

				}



			    if (!empty($evercisegroup_ids)) {
			    	$ratings = Rating::whereIn('evercisegroup_id', $evercisegroup_ids)->get();

				    foreach ($ratings as $key => $rating) {
				    	$stars[$rating->evercisegroup_id][] = $rating->stars;
				    }

			    }


				$month = date("m");
				$year = date("Y");

				return View::make('evercisegroups.class_hub')
						->with('evercisegroups' , $evercisegroups)
						->with('sessionDates' , $sessionDates )
						->with('totalMembers' , $totalMembers )
						->with('stars' , $stars)
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



		$subcategories = Subcategory::lists('name');
		natsort($subcategories);

		return View::make('evercisegroups.create')->with('subcategories', $subcategories);
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
				'classname' => 'required|max:100|min:5',
				'description' => 'required|max:5000|min:100',
				//'category' => 'required',
				'duration' => 'required|numeric|between:10,240',
				'maxsize' => 'required|numeric|between:1,200',
				'price' => 'required|numeric|between:1,1000',
				'image'	=> 'required',
				'gender'=> 'required',
				'venue'=> 'required',
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
			//$category = Input::get('category');
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

			$category1 = Input::get('category1');
			$category2 = Input::get('category2');
			$category3 = Input::get('category3');

			$categories = [];
			if ($category1 != '') array_push($categories, $category1);
			if ($category2 != '') array_push($categories, $category2);
			if ($category3 != '') array_push($categories, $category3);
			if (empty($categories)) return Response::json(['validation_failed' => 1, 'errors' => ['category1'=>'you must choose at least one category']]);

			// convert array of category names into id's
			foreach ($categories as $key => $category) {
				if (! $categories[$key] = Subcategory::where('name', $category)->pluck('id'))
					return Response::json(['validation_failed' => 1, 'errors' => [('category'.($key+1)) => 'One of the categories you have chosen is not in the list']]);
			}

			if ( ! Sentry::check()) return 'Not logged in';
			
			if (Trainer::where('user_id', $this->user->id)->count())
				$trainer = Trainer::where('user_id', $this->user->id)->get()->first();

			$evercisegroup = Evercisegroup::create(array(
				'name'=>$classname,
				'user_id'=>$this->user->id,
				//'category_id'=>$category,
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

			$evercisegroup->subcategories()->attach($categories);

			Trainerhistory::create(array('user_id'=> $this->user->id, 'type'=>'created_evercisegroup', 'display_name'=>$this->user->display_name, 'name'=>$evercisegroup->name));

			//return Response::json(route('home', array('display_name'=> $this->user->display_name)));
			//return Response::json($evercisegroup); // for testing
			//return View::make('evercisegroups.index');
			return Response::json(['callback' => 'gotoUrl', 'url' => route('evercisegroups.index')]);
		}
	}

	/**
	 * clone evercise group.
	 *
	 * @return Response
	 */
	public function cloneEG($id)
	{
		$evercisegroup = Evercisegroup::where('id', $id)->get()->first();

		if ($evercisegroup->user_id != $this->user->id) {
			return  Redirect::route('evercisegroups.index')->with('errorNotification', 'You do not own the class you are trying to clone');
		}
		
		return Redirect::route('evercisegroups.create')
				->with('name', $evercisegroup->name)
				->with('description', $evercisegroup->description)
				->with('duration', $evercisegroup->default_duration)
				->with('maxsize', $evercisegroup->capacity)
				->with('price', $evercisegroup->default_price)
				->with('lat', $evercisegroup->lat)
				->with('lng', $evercisegroup->lng)
				->with('location', array('address' => $evercisegroup->address , 'city' => $evercisegroup->town , 'postCode' => $evercisegroup->postcode ) )
				->with('image_full', 'profiles/'.$this->user->directory.'/'. $evercisegroup->image)
				->with( 'image' , $evercisegroup->image );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		 // return Redirect::route('home');

		//$trainerGroup = Sentry::findGroupByName('trainer');
		
		if($evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers')
			->with('subcategories.categories')
			->find($id))


		{
			if (Sentry::check() && $evercisegroup->user_id == $this->user->id) // This Group belongs to this User/Trainer
			{
				$evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers.Users')->find($id);

				if ($evercisegroup->user_id == $this->user->id) {
					//$evercisegroup_id;
					if ( ! Sentry::check()) return 'Not logged in';

					$directory = $this->user->directory;
					$trainerGroup = Sentry::findGroupByName('trainer');
			
					if ($this->user->inGroup($trainerGroup))
					{
						$evercisegroup = Evercisegroup::with('evercisesession.users')
						->with('evercisesession.sessionpayment')
						->find($id);

						if ($evercisegroup['futuresessions']->isEmpty())
						{
							//return Redirect::route('evercisegroups.index');

							return View::make('evercisegroups.trainer_show')
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
							$revenue = 0;
							$totalRevenue = 0;
							$averageRevenue = 0;
							$averageTotalRevenue = 0;

							$members = [];

							foreach ($evercisegroup->evercisesession as $key => $evercisesession) {
								$totalCapacity = $totalCapacity + $evercisegroup->capacity;
								$members[$key] = count($evercisesession['Sessionmembers']); // Count those members
								$totalSessionMembers= $totalSessionMembers + $members[$key];
								$revenue = $revenue + ($members[$key] * $evercisesession->price );
								$totalRevenue = $totalRevenue + ($evercisesession->price * $evercisegroup->capacity);
								++$i;
							}

							$averageSessionMembers = round($totalSessionMembers/$i, 1);
							$averageCapacity = round($totalCapacity/$i, 1);
							$averageRevenue = round($revenue/$i, 1);
							$averageTotalRevenue = round($totalRevenue/$i, 1);
							
							
							return View::make('evercisegroups.trainer_show')
								->with('evercisegroup' , $evercisegroup )
								->with('directory' , $directory)
								->with('totalSessionMembers' , $totalSessionMembers)
								->with('totalCapacity' , $totalCapacity)
								->with('averageSessionMembers' , $averageSessionMembers)
								->with('averageCapacity' , $averageCapacity)
								->with('revenue' , $revenue)
								->with('totalRevenue' , $totalRevenue)
								->with('averageTotalRevenue' , $averageTotalRevenue)
								->with('averageRevenue' , $averageRevenue)
								->with('members' , $members);
						}
					}
					else
					{
						return Redirect::route('home');
					}
				}

				return View::make('evercisegroups.show')
					->with('evercisegroup',$evercisegroup); // change to trainer show view
			}
			else
			{
				/* if there is not a trainer then return to discover page */

				try{
					$trainer=Trainer::with('user')
						->where('user_id', $evercisegroup->user_id)
						->first();
					}catch (Exception $e) {
						return Redirect::route('evercisegroups.search');
					}

				/* if trainer is tester and user is not redirect */

				$testers = Sentry::findGroupById(5); // get the tester group

				$testerLoggedIn = $this->user ? $this->user->inGroup($testers) : false; // see if user is a tester

				$userTrainer = Sentry::findUserById($evercisegroup->user_id); // create a sentry user object 
				
				// test to see if trainer is a tester and the user is not 
				if ($userTrainer->inGroup($testers) && $testerLoggedIn == false)
				{
					return	Redirect::route('evercisegroups.search');
				}

				/* if no upcoming sessions then redirct to discover page */
				if (	count($evercisegroup->evercisesession) == 0) {
					return Redirect::route('evercisegroups.search');
				}
					

				// create a array containing all members
				$members = [];
				$membersIds = [];
				$memberAllIds = [];
				$memberUsers = [];
				foreach ($evercisegroup->evercisesession as $key => $evercisesession) {
					$members[$evercisesession->id] = count($evercisesession['sessionmembers']); // Count those members
					foreach ($evercisesession['sessionmembers'] as $k => $sessionmember) {
						$membersIds[$evercisesession->id][] =  $sessionmember->user_id;	 
						$memberAllIds[]	 = 	$sessionmember->user_id;	
					}
				}

				if (!empty($memberAllIds)) {
					$memberUsers = User::whereIn('id', $memberAllIds)->distinct()->get();
				}


				$venue = Venue::with('facilities')->find($evercisegroup->venue_id);

				$ratings = Rating::with('rator')->where('evercisegroup_id', $evercisegroup->id)->orderBy('created_at')->get();

				/* open graph meta tags */
				/* git site https://github.com/chriskonnertz/open-graph */

				$og = new OpenGraph();

				/* try to create og if fails redirct to discover page */

				try{
					$og->title($evercisegroup->name)
			        ->type('article')
			        ->image(url().'/profiles/'.$trainer->user->directory.'/'.$evercisegroup->image,
			        	[
				            'width'     => 400,
				            'height'    => 200
				        ])
			        ->description($evercisegroup->description)
			        ->url();
				}catch (Exception $e) {
					return Redirect::route('evercisegroups.search');
				}
			    

				return View::make('evercisegroups.show')
					->with('evercisegroup',$evercisegroup)
					->with('trainer',$trainer)
					->with('members' , $members)
					->with('membersIds' , $membersIds)
					->with('memberUsers' , $memberUsers)
					->with('venue' , $venue)
					->with('ratings' , $ratings)
					->with('og' , $og)
					//->with('memberUsers' , $memberUsers)
					//->with('trainer',$trainerDetails)
					;
			}
		}
		else
		{
			return View::make('errors.missing');
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

		if ($evercisegroup->user_id != $this->user->id) {
			return Response::json(['mode' => 'hack']);
		}

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
		return Response::json(['mode' => 'redirect', 'url' => Route('evercisegroups.index')]);
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

	private function getLatLng($location)
	{
		/* check for seached location, otherwise use the ip address */
		if ( $location == '') {
			$location = Request::getClientIp();
			if ($location == '127.0.0.1' || $location == null) {
				$location = '188.39.12.12';
			}
		}

		try {
       		$geocode = Geocoder::geocode($location);
         	$latitude = $geocode->getLatitude();
        	$longitude = $geocode->getlongitude();
        } catch (Exception $e) {
            //return $e->getMessage();
        	$latitude = 0;
        	$longitude = 0;
        }
        return (['lat'=>$latitude, 'lng'=>$longitude]);
	}

	/**
	 * query eg's based on location
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function searchEg()
	{
		/* check if search form posted otherwise set default for radius */
		$radius = Input::get('radius',10);
	
		$category = Input::get('category');
		$locationString = Input::get('location');

        
        return $this->doSearch(['address'=>$locationString], $category, $radius);
    }

    public function doSearch($location, $category, $radius)
    {
    	//return $location['address'];
    	if (isset($location['lat']) && isset($location['lng']))
    	{
	    }
	    else
	    {
			$latlng = $this->getLatLng($location['address']);
	    }
    	$latitude = $latlng['lat'];
    	$longitude = $latlng['lng'];



        $page = Input::get('page', 1);

        $testers = Sentry::findGroupById(5);
		$testerLoggedIn = $this->user ? $this->user->inGroup($testers) : false;

        $haversine = '(3959 * acos(cos(radians(' . $latitude . ')) * cos(radians(lat)) * cos(radians(lng) - radians(' . $longitude . ')) + sin(radians(' . $latitude . ')) * sin(radians(lat))))';
        	
        /* set the number of arrays needed per level */
        $results = [[],[],[],[],[]];

        // SEARCH LEVEL 1
    	$results[0] = Evercisegroup::has('futuresessions')
        ->has('confirmed')
        ->has('tester', '<', $testerLoggedIn ? 5 : 1) // testing to make sure class does not belong to the tester
        ->whereHas('venue', function($query) use (&$haversine,&$radius){
        	$query->select( array( DB::raw($haversine . ' as distance')) )
        		  ->having('distance', '<', $radius);
        })
        ->whereHas('subcategories', function($query) use ($category){
        	$query->where('name', 'LIKE', '%'.$category.'%' );
        })
        ->with('venue')		
        ->with('user')
        ->with('ratings')
        ->with('futuresessions')
        ->get();


        // SEARCH LEVEL 2 ( if level 1 returns less than 9 results)
        if (count($results[0]) < 9)
        {
	    	$results[1] = Evercisegroup::has('futuresessions')
	        ->has('confirmed')
	        ->has('tester', '<', $testerLoggedIn ? 5 : 1) // testing to make sure class does not belong to the tester
	        ->whereHas('venue', function($query) use (&$haversine,&$radius){
	        	$query->select( array( DB::raw($haversine . ' as distance')) )
	        		  ->having('distance', '<', $radius);
	        })
	        ->whereHas('subcategories', function($query) use ($category){
	        	
		        $query->whereHas('categories', function($subquery) use ($category){
		        	$subquery->where('name', 'LIKE', '%'.$category.'%' );
		        });
	        })
	        //->with('categories')		
	        ->with('venue')
	        ->with('user')
	        ->with('ratings')
	        ->with('futuresessions')
	        ->get();
	    }

        //return var_dump($level2results);
        
        // SEARCH LEVEL 3 ( if level 1 and level 2 return less than 9 results)
        if (count($results[0]) + count($results[1]) < 9)
        {
	    	$results[2] = Evercisegroup::has('futuresessions')
	        ->has('confirmed')
	        ->has('tester', '<', $testerLoggedIn ? 5 : 1) // testing to make sure class does not belong to the tester
	        ->whereHas('venue', function($query) use (&$haversine,&$radius){
	        	$query->select( array( DB::raw($haversine . ' as distance')) )
	        		  ->having('distance', '<', $radius);
	        })
	        ->where('name', 'LIKE', '%'.$category.'%' )
	        ->with('venue')		
	        ->with('user')
	        ->with('ratings')
	        ->with('futuresessions')
	        ->get();
	    }

        // SEARCH LEVEL 4 ( if level 1, 2 and 3 return less than 9 results)
        if (count($results[0]) + count($results[1]) + count($results[2]) < 9)
        {
	    	$results[3] = Evercisegroup::has('futuresessions')
	        ->has('confirmed')
	        ->has('tester', '<', $testerLoggedIn ? 5 : 1) // testing to make sure class does not belong to the tester
	        ->whereHas('venue', function($query) use (&$haversine,&$radius){
	        	$query->select( array( DB::raw($haversine . ' as distance')) )
	        		  ->having('distance', '<', $radius);
	        })
	        ->where('description', 'LIKE', '%'.$category.'%' )
	        ->with('venue')		
	        ->with('user')
	        ->with('ratings')
	        ->with('futuresessions')
	        ->get();
	    }

        // SEARCH LEVEL 5 
        if (count($results[0]) + count($results[1]) + count($results[2]) + count($results[3]) < 9)
        {
	    	$results[4] = Evercisegroup::has('futuresessions')
	        ->has('confirmed')
	        ->has('tester', '<', $testerLoggedIn ? 5 : 1) // testing to make sure class does not belong to the tester
	        ->whereHas('venue', function($query) use (&$haversine,&$radius){
	        	$query->select( array( DB::raw($haversine . ' as distance')) )
	        		  ->having('distance', '<', $radius);
	        })
	        ->with('venue')		
	        ->with('user')
	        ->with('ratings')
	        ->with('futuresessions')
	        ->get();
	    }

	     // SEARCH LEVEL 6 
        if (count($results[0]) + count($results[1]) + count($results[2]) + count($results[3]) + count($results[4]) < 9)
        {
	    	$results[5] = Evercisegroup::has('futuresessions')
	        ->has('confirmed')
	        ->has('tester', '<', $testerLoggedIn ? 5 : 1) // testing to make sure class does not belong to the tester
	        ->whereHas('venue', function($query) use (&$haversine,&$radius){
	        	$query->select( array( DB::raw($haversine . ' as distance')) )
	        		  ->having('distance', '<', 200);
	        })
	        ->with('venue')		
	        ->with('user')
	        ->with('ratings')
	        ->with('futuresessions')
	        ->get();
	    }

	    $allResults = Evercisegroup::concatenateResults( $results );

	    $perPage = 12;
	    

	    if ($page > count($allResults) or $page < 1) { $page = 1; }
	    $offset = ($page * $perPage) - $perPage;
	    $articles = array_slice($allResults,$offset,$perPage);
	    $paginatedResults = Paginator::make($articles, count($allResults), $perPage);
	     

	    return View::make('evercisegroups.search')
	    		->with('places' , $paginatedResults->toJson())
	    		->with('evercisegroups' , $paginatedResults);
	}

	public function search_C($country)
	{
		$location = $country;
		$radius = 25;
		$category = '';
		return $this->doSearch(['address'=>$location], $category, $radius);
	}
	public function search_C_C($country, $city)
	{
		$location = $country.', '.$city;
		$radius = 25;
		$category = '';
		return $this->doSearch(['address'=>$location], $category, $radius);
	}
	public function search_C_C_A($country, $city, $area)
	{
		$location = $country.', '.$city.', '.$area;
		$category = '';
		$radius = 25;
		return $this->doSearch(['address'=>$location], $category, $radius);
	}
	public function search_C_C_A_C($country, $city, $area, $category)
	{
		$location = $country.', '.$city.', '.$area;
		$radius = 25;
		return $this->doSearch(['address'=>$location], $category, $radius);
	}
}