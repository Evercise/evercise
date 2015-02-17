<?php

class StaticController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    // FAQ is loaded from database, editable in Admin. Articles > How it works

	public function show()
	{
		$page = Route::getCurrentRoute()->getPath();
		return View::make('static.'.$page);
	}


}