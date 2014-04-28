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

		
		$professions = array(1=>'Zumba guy', 2=>'Yoga chick');

		return View::make('trainers.create')->with('professions', $professions);
	}
}