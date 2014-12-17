<?php

class LandingsController extends \BaseController {



    protected $evercisegroup;
    protected $sentry;
    protected $link;
    protected $input;
    protected $log;
    protected $session;
    protected $redirect;
    protected $paginator;
    protected $place;
    protected $elastic;
    protected $search;

    public function __construct(
        Evercisegroup $evercisegroup,
        Sentry $sentry,
        Link $link,
        Illuminate\Http\Request $input,
        Illuminate\Log\Writer $log,
        Illuminate\Session\Store $session,
        Illuminate\Routing\Redirector $redirect,
        Illuminate\Pagination\Factory $paginator,
        Illuminate\Config\Repository $config,
        Es $elasticsearch,
        Geotools $geotools,
        Place $place
    ) {

        parent::__construct();

        $this->evercisegroup = $evercisegroup;
        $this->sentry = $sentry;
        $this->link = $link;
        $this->input = $input;
        $this->log = $log;
        $this->place = $place;
        $this->session = $session;
        $this->redirect = $redirect;
        $this->paginator = $paginator;
        $this->config = $config;

        $this->elastic = new Elastic(
            $geotools::getFacadeRoot(),
            $this->evercisegroup,
            $elasticsearch::getFacadeRoot(),
            $this->log
        );
        $this->search = new Search($this->elastic, $this->evercisegroup, $this->log);

    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('landings.create');
	}


    public function display(){
        $url = str_replace(URL::to('/'), '', Request::url());

        $item = Config::get('landing_pages.'.$url);


        if(!isset($item['category'])) {
            return Redirect::route('home');
        }



        $params = [
            'size' => 10,
            'from' => 0,
            'radius' => '10mi',
            'search' => $item['category']
        ];

        $item['number_sessions'] = 0;

        $area = $this->place->where('name', 'London')->first();

        $i = 0;
        foreach($item['blocks']['large'] as $block) {
            $params['search'] = $block['name'];
            $searchResults = $this->search->getResults($area, $params);
            $total = 0;

            if($searchResults->total > 0) {
                $price = 0;

                foreach ($searchResults->hits as $evercisegroup) {

                    $total += count($evercisegroup->futuresessions);

                    foreach($evercisegroup->futuresessions as $session) {
                        if($price == 0 || $price > $session->price) {
                            $price = $session->price;
                        }
                    }
                }

                $item['blocks']['large'][$i]['from'] = '£'.$price;
            }

            $item['blocks']['large'][$i]['total'] = $total;

            $item['number_sessions'] += $total;

            $i++;
        }

        $i = 0;
        foreach($item['blocks']['small'] as $block) {
            $params['search'] = $block['name'];
            $searchResults = $this->search->getResults($area, $params);
            $total = 0;

            if($searchResults->total > 0) {
                $price = 0;

                foreach ($searchResults->hits as $evercisegroup) {

                    $total += count($evercisegroup->futuresessions);

                    foreach($evercisegroup->futuresessions as $session) {
                        if($price == 0 || $price > $session->price) {
                            $price = $session->price;
                        }
                    }
                }

                $item['blocks']['small'][$i]['from'] = '£'.$price;
            }


            $item['blocks']['small'][$i]['total'] = $total;


            $item['number_sessions'] += $total;
            $i++;
        }

        return View::make('v3.landing.user-categories', $item)->render();

    }


    public function landingSend() {

        $email = Input::get('email');
        $location = Input::get('location');
        $category_id = Input::get('category_id');

        $ppcCode = Functions::randomPassword(20);
        $ppc = Landing::create([ 'email'=>$email, 'code'=>$ppcCode, 'location'=>$location, 'category_id'=>$category_id ]);

        if ($ppc)
        {
            event('landing.user', [
                'email' => $email,
                'categoryId' => $category_id,
                'ppcCode' => $ppcCode,
                'location' => $location
            ]);
        }

       return $this->submitPpc($category_id, $ppcCode, $email);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$validator = Validator::make(
			Input::all(),
			[
				'email' => 'required|email|unique:users,email',
				'category' => '',
			]
		);
		if($validator->fails()) {
			if(Request::ajax())
	        { 
	        	$result = [
		            'validation_failed' => 1,
		            'errors' =>  $validator->errors()->toArray()
		         ];

				return Response::json($result);
	        }else{
	        	return Redirect::route('landing.category', ['category'=>Input::get('category')])
					->withErrors($validator)
					->withInput();
	        }
		}
		else {

			$email = Input::get('email');
			$categoryId = Input::get('category');

			$ppcCode = Functions::randomPassword(20);
			$ppc = Landing::create([ 'email'=>$email, 'code'=>$ppcCode, 'category_id'=>$categoryId ]);

			Session::put('ppcCode', $ppcCode);
			Session::put('email', $email);

			$category = Category::find($categoryId)->pluck('name');

			if ($ppc)
			{
				Event::fire('landing.ppc', [
		        	'email' => $email,
		        	'categoryId' => $categoryId,
	            'ppcCode' => $ppcCode
	        ]);
			}

			//return Redirect::to('users/create');
			return Response::json(['callback'=>'gotoUrl', 'url' => route('users.create')]);
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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


	// Facebook link on landing page clicked
	public function facebookPpc($categoryId)
	{
		$ppcCode = Functions::randomPassword(20);
		$ppc = Landing::create([ 'email'=>'facebook', 'code'=>$ppcCode, 'category_id'=>$categoryId ]);

		Session::put('ppcCategory', $categoryId);
		Session::put('ppcCode', $ppcCode);

		return Redirect::to('login/fb');
	}


	// Accept code from a pay-per-click generated email.
	public function submitPpc($categoryId, $ppcCode, $email)
	{
		Session::put('ppcCategory', $categoryId);
		Session::put('ppcCode', $ppcCode);

		return Redirect::route('register')->with('email', $email);
	}
	
	public function loadCategory($category)
	{
		if (array_key_exists($category, Config::get('values')['ppc_categories']))
		{
			$categoryId = Config::get('values')['ppc_categories'][$category];

			$category = Category::find($categoryId);
			
			return View::make('landings.create')
			->with('category', $category);
		}
		else
		{
			return Redirect::to('/');
		}
	}

	public function landCategory($cat)
	{
		return $this->loadCategory($cat);
	}

    public function categoryLanding($cat)
    {

    }

}