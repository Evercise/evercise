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
		if (Trainer::where('user_id', $user->id)->count())
		{
			$trainer = Trainer::where('user_id', $user->id)->get()->first();

			$evercisegroupsDB = Evercisegroup::where('user_id', $user->id)->get();
			foreach ($evercisegroupsDB as $eg)
			{
			    $evercisegroups[$eg->id] = $eg->name;
			}

			return View::make('evercisegroups.trainer_index')->with('evercisegroups' , $evercisegroups);
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
		if (Trainer::where('user_id', $user->id)->count())
			$trainer = Trainer::where('user_id', $user->id)->get()->first();
		else return 'Not a trainer';

		$categoriesDB = category::all();

		$categories = array();
		$categoryDescriptions = array();
		foreach ($categoriesDB as $cat)
		{
		    $categories[$cat->id] = $cat->name;
		    $categoryDescriptions[$cat->id] = $cat->description;
		}

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
				'classname' => 'required',
				'description' => 'required',
				'category' => 'required',
				//'summary' => 'required',
				'duration' => 'required',
				'maxsize' => 'required',
				'price' => 'required',
				//'customurl' => 'required',
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
			//$customurl = Input::get('customurl');

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
				//'customurl'=>$customurl
			));

			//return Response::json(route('home', array('display_name'=> $user->display_name)));
			return Response::json($evercisegroup); // for testing
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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