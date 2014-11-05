<?php


class EvercisegroupsController extends \BaseController
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Evercisegroup::getHub($this->user);
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

        $venues = Venue::usersVenues($this->user->id);

        return View::make('v3.classes.create')->with('venues', $venues)->with('subcategories', $subcategories);
        //return View::make('evercisegroups.create')->with('subcategories', $subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        return Evercisegroup::validateAndStore($this->user);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cloneEG($id)
    {
        $evercisegroup = Evercisegroup::getById($id);

        if (!$evercisegroup->checkIfUserOwnsClass($this->user)) {
            return Redirect::route('evercisegroups.index')->with('errorNotification', 'You do not own this class');
        }

        return Redirect::route('evercisegroups.create')
            ->with('name', $evercisegroup->name)
            ->with('description', $evercisegroup->description)
            ->with('duration', $evercisegroup->default_duration)
            ->with('maxsize', $evercisegroup->capacity)
            ->with('price', $evercisegroup->default_price)
            ->with('lat', $evercisegroup->lat)
            ->with('lng', $evercisegroup->lng)
            ->with(
                'location',
                array(
                    'address'  => $evercisegroup->address,
                    'city'     => $evercisegroup->town,
                    'postCode' => $evercisegroup->postcode
                )
            )
            ->with('image_full', 'profiles/' . $this->user->directory . '/' . $evercisegroup->image)
            ->with('image', $evercisegroup->image);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if ($evercisegroup = Evercisegroup::with('Evercisesession.Sessionmembers.Users')
            ->with('evercisesession.sessionpayment')
            ->with('subcategories.categories')
            ->find($id)
        ) {
            if (Sentry::check() && $evercisegroup->user_id == $this->user->id
            ) // This Group belongs to this User/Trainer
            {
                return $evercisegroup->showAsOwner($this->user);
            } else // This group does not belong to this user
            {
                $data = $evercisegroup->showAsNonOwner($this->user);

                return View::make('v3.classes.class_page')
                    ->with('data', $data);
            }
        } else {
            return View::make('errors.missing');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
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
     * @param  int $id
     * @return Route
     */
    public function destroy($id)
    {
        $evercisegroup = Evercisegroup::with('evercisesession.sessionmembers')->find($id);

        Event::fire('evecisegroup.delete', [$this->user, $evercisegroup]);

        return $evercisegroup->deleteGroup($this->user);
    }


    /**
     * Bring up delete view in window
     *
     * @param  int $id
     * @return Route
     */
    public function deleteEG($id)
    {
        $evercisegroup = Evercisegroup::with('evercisesession.sessionmembers')->find($id);

        $deletableStatus = 0;
        $deletableStatus = count($evercisegroup->sessionmember) ? 3 : ($evercisegroup->evercisesession->isEmpty(
        ) ? 1 : 2);
        return $deletableStatus ? View::make('evercisegroups.delete')->with('id', $id)->with(
            'name',
            $evercisegroup->name
        )->with('evercisegroup', $evercisegroup)->with('deleteable', $deletableStatus) : Redirect::route('home');
    }


    /*
	 * query eg's based on location
	 *
	 * @return Response
	 */
    public function search($all_segments = [])
    {

        $search = Evercisegroup::parseSegments($all_segments);

        dd($search);

        /* check if search form posted otherwise set default for radius */
        $radius = Input::get('radius', 10);

        $category = Input::get('category');
        $locationString = Input::get('location');


        return Evercisegroup::doSearch(['address' => $locationString], $category, $radius, $this->user);
    }

    public function search_C($country)
    {
        $location = $country;
        $radius = 25;
        $category = '';
        return Evercisegroup::doSearch(['address' => $location], $category, $radius);
    }


}