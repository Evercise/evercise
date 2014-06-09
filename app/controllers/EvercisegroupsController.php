<?php

class EvercisegroupsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( ! Sentry::check()) return 'Not logged in';

		$directory = $this->user->directory;
		$trainerGroup = Sentry::findGroupByName('trainer');

		if ($this->user->inGroup($trainerGroup))
		{
			$evercisegroups = Evercisegroup::with('Evercisesession')->where('user_id', $this->user->id)->get();

			if ($evercisegroups->isEmpty()) {
				return View::make('evercisegroups.first_class');
			}else{
				$sessionDates = array();
				$totalMembers = array();
				$totalCapacity = array();

				foreach ($evercisegroups as $key => $value) {

					$sessionDates[$key] = $this->arrayDate($value->EverciseSession->lists('date_time', 'id'));
					$totalCapacity[] =  $value->capacity;
					foreach ($value['Evercisesession'] as $k => $val) {
						$totalMembers[]= $val->members;
					}

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

		if ( ! Sentry::check()) return 'Not logged in';

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

		JavaScript::put(array('initSlider_price' =>  json_encode(array('name'=>'price', 'min'=>0, 'max'=>99, 'step'=>0.50, 'value'=>1))));
		JavaScript::put(array('initSlider_duration' =>  json_encode(array('name'=>'duration', 'min'=>0, 'max'=>120, 'step'=>5, 'value'=>1))));
		JavaScript::put(array('initSlider_maxsize' =>  json_encode(array('name'=>'maxsize', 'min'=>0, 'max'=>99, 'step'=>1, 'value'=>1))));

        JavaScript::put(array('initImage' => 1 )); // Initialise image JS.
		JavaScript::put(array('initEvercisegroups' => 1 )); // Initialise EverciseGroups JS.
		JavaScript::put(array('MapWidgetloadScript' => 1 )); // Initialise map JS.
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
				'maxsize' => 'required|numeric|between:1,1000',
				'price' => 'required|numeric|between:1,120',
				'image'	=> 'required',
				'lat' => 'required',
				'long' => 'required',
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
			$duration = Input::get('duration');
			$maxsize = Input::get('maxsize');
			$price = Input::get('price');
			$image = Input::get('image');
			$address = Input::get('address');
			$city = Input::get('city');
			$postcode = Input::get('postcode');
			$lat = Input::get('lat');
			$lng = Input::get('long');

			if ( ! Sentry::check()) return 'Not logged in';
			
			if (Trainer::where('user_id', $this->user->id)->count())
				$trainer = Trainer::where('user_id', $this->user->id)->get()->first();

			$evercisegroup = Evercisegroup::create(array(
				'name'=>$classname,
				'user_id'=>$this->user->id,
				'category_id'=>$category,
				'description'=>$description,
				'default_duration'=>$duration,
				'capacity'=>$maxsize,
				'default_price'=>$price,
				'image' => $image,
				'address'=>$address,
				'town'=>$city,
				'postcode'=>$postcode,
				'lat'=>$lat,
				'lng' => $lng
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
		if (!Sentry::check()) return Redirect::route('home');

		$trainerGroup = Sentry::findGroupByName('trainer');

		if ($this->user->inGroup($trainerGroup))
		{
			$evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers.Users')->find($id);

			if ($evercisegroup->user_id == $this->user->id) {
				//$evercisegroup_id;
		if ( ! Sentry::check()) return 'Not logged in';

		$directory = $this->user->directory;
		$trainerGroup = Sentry::findGroupByName('trainer');
		
		if ($this->user->inGroup($trainerGroup))
		{
			$evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers.Users')->find($id);
			if ($evercisegroup['Evercisesession']->isEmpty())
			{
				return Redirect::route('evercisegroups.index');
			}
			else
			{
				$i = 0;
				$totalSessionMembers = 0;
				$totalCapacity = 0;
				$averageSessionMembers = 0;
				$averageCapacity = 0;

				$members = [];
				foreach ($evercisegroup->Evercisesession as $key => $value) {
					$totalCapacity = $totalCapacity + $evercisegroup->capacity;
					$members[$key] = count($value['Sessionmembers']); // Count those members
					$totalSessionMembers= $totalSessionMembers + $members[$key];
					++$i;
				}

				$averageSessionMembers = round($totalSessionMembers/$i, 1);
				$averageCapacity = round($totalCapacity/$i, 1);

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
		else
		{
			$evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers.Users')->find($id);

			return View::make('evercisegroups.show')->with('evercisegroup',$evercisegroup);
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
	 * @return Response
	 */
	public function destroy($id)
	{

		$evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers')->find($id);
		$name = $evercisegroup->name;

		// If Evercisegroup contains Evercisesessions, delete them all.
		if (!$evercisegroup['Evercisesession']->isEmpty())
		{
			foreach ($evercisegroup['Evercisesession'] as $value) {
				$value->delete();
			}
		}
		
		// Now, delete actual Evercisegroup too.
		$evercisegroupForDeletion = Evercisegroup::find($id);
		//$evercisegroupForDeletion->delete();

		Trainerhistory::create(array('user_id'=> $this->user->id, 'type'=>'deleted_evercisegroup', 'display_name'=>$this->user->display_name, 'name'=>$evercisegroup->name));
		
		return Route('evercisegroups.index');
	}


	/**
	 * Bring up delete view in window
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteEG($id)
	{

		$evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers')->find($id);
		$name = $evercisegroup->name;

		if (false /* If there are Users signed up */)
		{
			return View::make('evercisegroups.delete')->with('id',$id)->with('name',$name)->with('evercisegroup',$evercisegroup)->with('deleteable',3);
		}
		else
		{
			if ($evercisegroup['Evercisesession']->isEmpty())
			{
				//return $evercisegroup;
				return View::make('evercisegroups.delete')->with('id',$id)->with('name',$name)->with('evercisegroup',$evercisegroup)->with('deleteable',1);
			}
			else
			{
				//return $evercisegroup;
				return View::make('evercisegroups.delete')->with('id',$id)->with('name',$name)->with('evercisegroup',$evercisegroup)->with('deleteable',2);
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

        $haversine = '(3959 * acos(cos(radians(' . $geocode->getLatitude() . ')) * cos(radians(lat)) * cos(radians(lng) - radians(' . $geocode->getLongitude() . ')) + sin(radians(' . $geocode->getLatitude() . ')) * sin(radians(lat))))';

        $places = DB::table('evercisegroups')
	    ->select( array('*', DB::raw($haversine . ' as distance')) )
	    ->whereBetween('lat', array(0,100))
	    ->where('category_id' , $category)
	    ->orderBy('distance', 'ASC')
	    ->having('distance', '<', $radius)
	    ->get();


	    JavaScript::put(array('classes' => json_encode($places) ));
	    JavaScript::put(array('MapWidgetloadScript' =>  json_encode(array('discover'=> true))));


	    return View::make('evercisegroups.search')
	    		->with('places' , $places);
	}

	

}