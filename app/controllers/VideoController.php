<?php

class VideoController extends \BaseController {

	/**
	 * show video modal.
	 *
	 * @return Response
	 */

	public function create()
	{
        return View::make('layouts.videoModal');
	}
}