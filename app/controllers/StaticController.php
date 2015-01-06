<?php

class StaticController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show()
	{
		$page = Route::getCurrentRoute()->getPath();
		return View::make('static.'.$page);
	}

}