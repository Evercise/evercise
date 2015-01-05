<?php

class HomeController extends BaseController {


    /**
     * @var Slider
     */
    private $slider;
    /**
     * @var Articles
     */
    private $articles;

    public function __construct(Slider $slider, Articles $articles){

        $this->slider = $slider;
        $this->articles = $articles;
    }
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
        $slider = $this->slider->getItems(5);

        $articles = $this->articles->getMainPageArticles(3);

        $searchController = App::make('SearchController');
        $featured = $searchController->getClasses([
            'size' => 9,
            'radius' => '10mi',
            'featured' => true,
            'location' => 'London'
        ]);


        if(count($featured->hits) < 6) {
            Log::error('Add More featured Classes');
        }


        /**
         * foreach($slider as $slide)
         * $image = 'files/slider/$prefix_$slide->image'
         *
         * $evercisegroup = $slide->evercisegroup
         */


		return View::make('v3.home', compact('featured', 'slider', 'articles'));
	}

}