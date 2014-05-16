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
		$user = Sentry::getUser();

		$directory = $user->directory;
		$trainerGroup = Sentry::findGroupByName('trainer');

		if ($user->inGroup($trainerGroup))
		{
			$trainer = Trainer::where('user_id', $user->id)->get()->first();

			$evercisegroups = Evercisegroup::with('EverciseSession')->where('user_id', $user->id)->get();

			if ($evercisegroups->isEmpty()) {
				return View::make('evercisegroups.first_class');
			}else{
				$sessionDates = array();

				foreach ($evercisegroups as $key) {

					$sessionDates[] = $this->arrayDate($key->EverciseSession->lists('date_time'));
				}

				$month = date("m");
				$year = date("Y");

				//JavaScript::put(array('initSlider_price' =>  json_encode(array('name'=>'price', 'min'=>0, 'max'=>99, 'step'=>0.50, 'value'=>1))));
				JavaScript::put(array('calendarSlide' => 1 )); // Initialise calendarSlide JS. priority 1 (0 is first)
				return View::make('evercisegroups.trainer_index')->with('evercisegroups' , $evercisegroups)->with('sessionDates' , $sessionDates )->with('year', $year)->with('month', $month)->with('directory', $directory);	
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
		$user = Sentry::getUser();
		$trainerGroup = Sentry::findGroupByName('trainer');

		if ($user->inGroup($trainerGroup))
		{
			$trainer = Trainer::where('user_id', $user->id)->get()->first();
		}
		//else return 'Not a trainer';

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
		JavaScript::put(array('initSlider_duration' =>  json_encode(array('name'=>'duration', 'min'=>0, 'max'=>99, 'step'=>0.50, 'value'=>1))));
		JavaScript::put(array('initSlider_maxsize' =>  json_encode(array('name'=>'maxsize', 'min'=>0, 'max'=>99, 'step'=>0.50, 'value'=>1))));

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
		// echo 'Evercisegroups Store';
		// exit;

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
			//$summary = Input::get('summary');
			$duration = Input::get('duration');
			$maxsize = Input::get('maxsize');
			$price = Input::get('price');
			$image = Input::get('image');
			//$customurl = Input::get('customurl');
			$address = Input::get('address');
			$city = Input::get('city');
			$postcode = Input::get('postcode');
			$lat = Input::get('lat');
			$long = Input::get('long');

			if ( ! Sentry::check()) return 'Not logged in';

			$user = Sentry::getUser();
			
			if (Trainer::where('user_id', $user->id)->count())
				$trainer = Trainer::where('user_id', $user->id)->get()->first();

			$evercisegroup = Evercisegroup::create(array(
				'name'=>$classname,
				'user_id'=>$user->id,
				'category_id'=>$category,
				'description'=>$description,
				//'summary'=>$summary,
				'default_duration'=>$duration,
				'capacity'=>$maxsize,
				'default_price'=>$price,
				'image' => $image,
				'address'=>$address,
				'town'=>$city,
				'postcode'=>$postcode,
				'lat'=>$lat,
				'long' => $long
				//'customurl'=>$customurl
			));

			//return Response::json(route('home', array('display_name'=> $user->display_name)));
			//return Response::json($evercisegroup); // for testing
			//return View::make('evercisegroups.index');
			return Response::json(route('evercisegroups.index'));
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
		return View::make('evercisegroups.show');
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
		//
	}

}