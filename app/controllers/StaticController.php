<?php

class StaticController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show($view = 'about')
	{
		return View::make('static.'.$view);
	}
}