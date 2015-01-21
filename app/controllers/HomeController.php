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


        $blocks = [];

        $homepage = Config::get('homepage');



        foreach($homepage['blocks'] as $key => $block) {

            $blocks[$key] = array_except($block, ['params']);
            $blocks[$key]['results'] = $searchController->getClasses($block['params'], true);
        }


        unset($homepage['blocks']);


        /** AVAILABLE */
        /**
         *  $blocks  > All class blocks with titles, links and results. Some have Backgrounds attached to them.
         *  $homepage['popular_searches']  > Dropdown Popular Searches
         *  $homepage['category_blocks']  > Colored Category blocks on the page
         *  $homepage['category_tags']  > Tag Cloud of Categories
         */


        /**
         * foreach($slider as $slide)
         * $image = 'files/slider/$prefix_$slide->image'
         *
         * $evercisegroup = $slide->evercisegroup
         */


		return View::make('v3.home', compact('blocks', 'slider', 'articles', 'homepage'));
	}

}