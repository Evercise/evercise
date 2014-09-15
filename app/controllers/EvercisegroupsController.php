<?php


class EvercisegroupsController extends \BaseController {


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if (! $hub = Evercisegroup::getHub()) // Trainer has not yet created any classes, so show the 'Create you first Class' page
        {
            return View::make('evercisegroups.first_class');
        }
        else
        {
            return View::make('evercisegroups.class_hub')
                ->with('evercisegroups', $hub['evercisegroups'])
                ->with('sessionDates', $hub['sessionDates'])
                ->with('totalMembers', $hub['totalMembers'])
                ->with('stars', $hub['stars'])
                ->with('totalCapacity', $hub['totalCapacity'])
                ->with('year', date("Y"))->with('month', date("m"))
                ->with('directory', Sentry::getUser()->directory);
        }
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        // Get names of subcategories and sort alphabetically
		$subcategories = Subcategory::lists('name');
		natsort($subcategories);

		return View::make('evercisegroups.create')->with('subcategories', $subcategories);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $response = Evercisegroup::validateAndStore(Input::all());
        return Response::json($response);
	}

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cloneEG($id)
	{
		$evercisegroup = Evercisegroup::getById($id);

		if (! $evercisegroup->checkIfUserOwnsClass())
			return  Redirect::route('evercisegroups.index')->with('errorNotification', 'You do not own this class');

		return Redirect::route('evercisegroups.create')
            ->with('name', $evercisegroup->name)
            ->with('description', $evercisegroup->description)
            ->with('duration', $evercisegroup->default_duration)
            ->with('maxsize', $evercisegroup->capacity)
            ->with('price', $evercisegroup->default_price)
            ->with('lat', $evercisegroup->lat)
            ->with('lng', $evercisegroup->lng)
            ->with('location', array('address' => $evercisegroup->address , 'city' => $evercisegroup->town , 'postCode' => $evercisegroup->postcode ) )
            ->with('image_full', 'profiles/'.Sentry::getUser()->directory.'/'. $evercisegroup->image)
            ->with( 'image' , $evercisegroup->image );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        if($evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers.Users')
            ->with('evercisesession.sessionpayment')
            ->with('subcategories.categories')
            ->find($id))
		{
			if (Sentry::check() && $evercisegroup->user_id == Sentry::getUser()->id) // This Group belongs to this User/Trainer
			{
                if (! $viewParams = $evercisegroup->showAsOwner()) // Id's do not match
                {
                    return View::make('evercisegroups.trainer_show')
                        ->with('evercisegroup', $evercisegroup)
                        ->with('directory', Sentry::getUser()->directory)
                        ->with('members', 0);
                }
                else
                {
                    return View::make('evercisegroups.trainer_show')
                        ->with('evercisegroup', $evercisegroup)
                        ->with('directory', Sentry::getUser()->directory)
                        ->with('totalSessionMembers', $viewParams['totalSessionMembers'])
                        ->with('totalCapacity', $viewParams['totalCapacity'])
                        ->with('averageSessionMembers', $viewParams['averageSessionMembers'])
                        ->with('averageCapacity', $viewParams['averageCapacity'])
                        ->with('revenue', $viewParams['revenue'])
                        ->with('totalRevenue', $viewParams['totalRevenue'])
                        ->with('averageTotalRevenue', $viewParams['averageTotalRevenue'])
                        ->with('averageRevenue', $viewParams['averageRevenue'])
                        ->with('members', $viewParams['members']);
                }
			}
			else // This group does not belong to this user
			{
                if(! $viewParams = $evercisegroup->showAsNonOwner()) // User is not allowed to view this class
                {
                    return Redirect::route('evercisegroups.search');
                }
                else
                {
                    return View::make('evercisegroups.show')
                        ->with('evercisegroup', $evercisegroup)
                        ->with('trainer', $viewParams['trainer'])
                        ->with('members', $viewParams['members'])
                        ->with('membersIds', $viewParams['membersIds'])
                        ->with('memberUsers', $viewParams['memberUsers'])
                        ->with('venue', $viewParams['venue'])
                        ->with('allRatings', $viewParams['allRatings'])
                        ->with('fakeUsers', $viewParams['fakeUsers'])
                        ->with('og', $viewParams['og']);
                }
			}
		}
		else
		{
			return View::make('errors.missing');
		}
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		echo('edit');
		exit;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		echo('update');
		exit;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Route
	 */
	public function destroy($id)
	{
		$evercisegroup = Evercisegroup::with('evercisesession.sessionmembers')->find($id);

        Event::fire('evecisegroup.delete', [Sentry::getUser(), $evercisegroup]);

        return $evercisegroup->deleteGroup();
	}


	/**
	 * Bring up delete view in window
	 *
	 * @param  int  $id
	 * @return Route
	 */
	public function deleteEG($id)
	{
		$evercisegroup = Evercisegroup::with('evercisesession.sessionmembers')->find($id);

        $deletableStatus = 0;
        $deletableStatus = count($evercisegroup->sessionmember) ? 3 : ($evercisegroup->evercisesession->isEmpty() ? 1 : 2);
        return $deletableStatus ? View::make('evercisegroups.delete')->with('id', $id)->with('name', $evercisegroup->name)->with('evercisegroup', $evercisegroup)->with('deleteable', $deletableStatus) : Redirect::route('home');
	}

    /*
	 * query eg's based on location
	 *
	 * @return Response
	 */
	public function searchEg()
	{
		/* check if search form posted otherwise set default for radius */
		$radius = Input::get('radius',10);
	
		$category = Input::get('category');
		$locationString = Input::get('location');

        $searchResults = Evercisegroup::doSearch(['address' => $locationString], $category, $radius, Input::get('page', 1));

        return View::make('evercisegroups.search')
            ->with('places', json_encode($searchResults['mapResult']))
            ->with('evercisegroups', $searchResults['paginatedResults']);
    }



}