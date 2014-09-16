<?php


class SearchController extends \BaseController
{

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
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if ($evercisegroup = $this->evercisegroup->with('Evercisesession.Sessionmembers.Users')
            ->with('evercisesession.sessionpayment')
            ->with('subcategories.categories')
            ->find($id)
        ) {
            if ($this->sentry->check() && $evercisegroup->user_id == $this->user->id) // This Group belongs to this User/Trainer
            {
                return $evercisegroup->showAsOwner($this->user);
            } else // This group does not belong to this user
            {
                return $evercisegroup->showAsNonOwner($this->user);
            }
        } else {
            return View::make('errors.missing');
        }

    }

    /**
     * Parse All Params and forward it to the right function
     * @param array $all_segments
     */
    public function parseUrl($all_segments = '')
    {
        $link = $this->link->checkLink($all_segments, $this->input->get('area_id', false));

        if ($link) {

            switch ($link->type) {
                case 'AREA':
                case 'STATION':
                case 'ZIP':
                    return $this->search($link->getArea);
                    break;
                case 'CLASS':
                    return $this->show($link->getClass);
                    break;
            }
        } elseif( !$link && !$this->input->get('location', false) && $all_segments != '') {

            $this->log->info('Somebody tried to access a missing URL '.$this->input->url());

            $input['allsegments'] = '';
            return $this->redirect->route(
                'search.parse',
                $input
            );
        }

        return $this->search();
    }


    /**
     * query eg's based on location
     *
     * @return Response
     */
    public function search($area = false)
    {
        $input = array_filter($this->input->all());

        /** Clean up empty Arrays  */
        foreach($input as $key => $val) {
            if(empty($val)) unset($input[$key]);
        }

        unset($input['area_id']);

        if (!empty($input['per_page']) && in_array($this->config->get('evercise.per_page'), $input['per_page'])) {
            $this->session->put('PER_PAGE', $input['per_page']);
            unset($input['per_page']);
        }

        /** If Area is not a object lets add it to the database so we have it for later use  */
        if (!$area instanceof Place) {

            $this->log->info('Not a Place');
            if (!isset($input['location']) || empty($input['location'])) {
                $input['location'] = 'London';
            }
            $location = $this->place->getByLocation($input['location']);

            unset($input['location']);




            /** We have save the location to the DB so we can redirect the user to the new URL now */

            $this->log->info('Redirect TO: ' . $location->link->permalink . '?' . http_build_query($input));
            $input['allsegments'] = $location->link->permalink;

            return $this->redirect->route(
                'search.parse',
                $input,
                301
            );


        }


        $radius = $this->input->get('radius', $this->config->get('evercise.default_radius'));
        $size = $this->session->get('PER_PAGE', $this->config->get('evercise.default_per_page'));


        if (!empty($area->min_radius) && str_replace('mi','',$area->min_radius) > str_replace('mi','',$radius)) {
            $radius = $area->min_radius; 
        }

        $page = $this->input->get('page', 1);
        $search = $this->input->get('search');

        $params = [
            'size'   => $size,
            'from'   => (($page - 1) * $size),
            'radius' => (in_array(
                $radius,
                array_values($this->config->get('evercise.radius'))
            ) ? $radius : $this->config->get(
                'evercise.default_radius'
            )),
            'search' => $search
        ];


        $searchResults = $this->search->getResults($area, $params);


        /* Overide $params arr so it will show the map results only */
        $params['size'] = $this->config->get('evercise.max_display_map_results');
        $params['from'] = 0;
        $mapResults = $this->search->cleanMapResults($this->search->getResults($area, $params));


        $paginatedResults = $this->paginator->make($searchResults->hits, $searchResults->total, $size);


        $data = [
            'area'           => $area,
            'places'         => json_encode($mapResults),
            'evercisegroups' => $paginatedResults,
            'radius'         => $radius,
            'allowed_radius' => array_flip($this->config->get('evercise.radius')),
            'page'           => $page,
            'search'         => $search
        ];


        return View::make('evercisegroups.search')
            ->with($data);

    }


}