<?php

class VideoController extends \BaseController {

	/**
	 * show video modal.
	 *
	 * @return Response
	 */

	public function create()
	{

        return Redirect::to('/');


        return View::make('layouts.videoModal');
	}
}