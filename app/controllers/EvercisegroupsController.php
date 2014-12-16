<?php


class EvercisegroupsController extends \BaseController
{



    protected $evercisegroup;
    protected $input;
    protected $log;
    protected $elastic;

    public function __construct(
        Evercisegroup $evercisegroup,
        Illuminate\Http\Request $input,
        Illuminate\Log\Writer $log,
        Illuminate\Config\Repository $config,
        Es $elasticsearch,
        Geotools $geotools
    ) {

        parent::__construct();

        $this->evercisegroup = $evercisegroup;
        $this->input = $input;
        $this->log = $log;
        $this->config = $config;

        $this->elastic = new Elastic(
            $geotools::getFacadeRoot(),
            $this->evercisegroup,
            $elasticsearch::getFacadeRoot(),
            $this->log
        );

    }



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
    public function create($clone_id = NULL)
    {
        // Get names of subcategories and sort alphabetically
        $subcategories = Subcategory::lists('name');
        natsort($subcategories);

        $venues = Venue::usersVenues($this->user->id);
        $facilities = Facility::getLists();

        if ($clone_id) {
            $cloneGroup = Evercisegroup::find($clone_id);

            if (!$cloneGroup->checkIfUserOwnsClass($this->user)) {
                return Redirect::route('evercisegroups.index')->with('errorNotification', 'You do not own this class');
            }
        }

        return View::make('v3.classes.create')
            ->with('venues', $venues)
            ->with('facilities', $facilities)
            ->with('subcategories', $subcategories)
            ->with('cloneGroup', isset($cloneGroup) ? $cloneGroup : NULL);
        //return View::make('evercisegroups.create')->with('subcategories', $subcategories);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cloneEG($id)
    {
        return Redirect::route('evercisegroups.create', [$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id, $preview = NULL)
    {


        $data = $this->elastic->getSingle($id);



        if (!empty($data->hits[0]->_source)){

            $class = $data->hits[0]->_source;

            if(is_numeric($id)) {
                return Redirect::route('class.show', [$id => $class->slug], 301);
            }


            $og = new OpenGraph();

            /* try to create og if fails redirect to discover page */

            try {
                $og->title($class->name)
                    ->type('article')
                    ->image(
                        url() .'/'.$class->user->directory . '/thumb_' . $class->image,
                        [
                            'width'  => 150,
                            'height' => 156
                        ]
                    )
                    ->description($class->description)
                    ->url();
                $class->og = $og;
            } catch (Exception $e) {
                $class->og = [];
            }

            /** Overwrite Venue because of amenities */
            $class->venue = Venue::with('facilities')->find($class->venue_id);


            event('class.viewed', [$class, $this->user]);

            if (Sentry::check() && $class->user_id == $this->user->id)
            // This Group belongs to this User/Trainer
            {
                return View::make('v3.classes.class_page')
                    ->with('preview', 'preview')
                    ->with('data', (array)$class);
            }
            else // This group does not belong to this user
            {
                return View::make('v3.classes.class_page')
                    ->with('data', (array)$class);
            }
        } else {
            //return View::make('errors.missing');
            return Redirect::route('home')->with('notification', 'this class does not exist');
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


        $delete = $evercisegroup->deleteGroup($this->user);

        event(' class.deleted', [$this->user, $evercisegroup]);

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
        $deletableStatus = count($evercisegroup->sessionmember) ? 3 : ($evercisegroup->evercisesession->isEmpty() ? 1 : 2);

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

        return Evercisegroup::doSearch(['address' => $location], $category, $radius, $this->user);
    }


}