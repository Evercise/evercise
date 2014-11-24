<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{

        $searchController = App::make('SearchController');
        $featured = $searchController->getClasses([
            'size' => 5,
            'radius' => '5mi',
            'featured' => true,
            'location' => 'London'
        ]);


		return View::make('v3.home', compact('featured'));
	}

}