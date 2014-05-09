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
		$trainerGroup = Sentry::findGroupByName('trainer');

		if ($user->inGroup($trainerGroup))
		{
			$trainer = Trainer::where('user_id', $user->id)->get()->first();

			$evercisegroupsDB = Evercisegroup::where('user_id', $user->id)->get();
			$evercisegroups = array();
			foreach ($evercisegroupsDB as $eg)
			{
			    $evercisegroups[$eg->id] = $eg->name;
			}

			$calendarData = array();

			$template = '
			   {table_open}<table border="0" cellpadding="0" cellspacing="0" id="calendar">{/table_open}

			   {heading_row_start}<tr>{/heading_row_start}

			   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

			   {heading_row_end}</tr>{/heading_row_end}

			   {week_row_start}<tr>{/week_row_start}
			   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
			   {week_row_end}</tr>{/week_row_end}

			   {cal_row_start}<tr>{/cal_row_start}
			   {cal_cell_start}<td>{/cal_cell_start}

			   {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
			   {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

			   {cal_cell_no_content}<a href="#" id="day_{day}">{day}</a>{/cal_cell_no_content}
			   {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

			   {cal_cell_blank}&nbsp;{/cal_cell_blank}

			   {cal_cell_end}</td>{/cal_cell_end}
			   {cal_row_end}</tr>{/cal_row_end}

			   {table_close}</table>{/table_close}
			';

			Calendar::initialize(array('template' => $template));

			echo date("M");
			exit;

			return View::make('evercisegroups.trainer_index')->with('evercisegroups' , $evercisegroups)->with('calendarData', $calendarData)->with('year', 2014)->with('month', 6);
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