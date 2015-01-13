<?php
use Carbon\Carbon;

class SearchModel
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


    public function search($area = false, $input = [], $user = false) {


        /**
         *
         * search
         * location
         * city
         * per_page or size
         * page
         * sort
         * distance
         * venue_id
         *
         *
         */

        $landing = false;
        if(!empty($input['landing'])) {
            $landing = $input['landing'];
            unset($input['landing']);
        }

        /** Clean up empty Arrays  */
        foreach ($input as $key => $val) {
            if (empty($val)) {
                unset($input[$key]);
            }
        }

        unset($input['area_id']);

        if (!empty($input['per_page']) && in_array($input['per_page'], $this->config->get('evercise.per_page'))) {
            $this->session->put('PER_PAGE', $input['per_page']);
            unset($input['per_page']);
        }
        if (!empty($input['size']) && in_array($input['size'], $this->config->get('evercise.per_page'))) {
            $this->session->put('PER_PAGE', $input['size']);
            unset($input['size']);
        }

        /** If Area is not a object lets add it to the database so we have it for later use  */
        if (!$area instanceof Place) {

            $this->log->info('Not a Place');
            if (!isset($input['location']) || empty($input['location'])) {
                $input['location'] = 'London';
            }
            if (!isset($input['city']) || empty($input['city'])) {
                $input['city'] = 'London';
            }
            $location = $this->place->getByLocation($input['location'], $input['city']);


            if (is_null($location)) {

                $this->log->info('Address ERROR: ' . $input['location'] . '?' . http_build_query($input));

                $input['allsegments'] = '';
                unset($input['location']);
                unset($input['city']);


                return ['redirect' => $this->redirect->route(
                    'search.parse',
                    $input,
                    301
                )];

            } else {
                unset($input['location']);
                unset($input['city']);
            }

            /** We have save the location to the DB so we can redirect the user to the new URL now */

            $this->log->info('Redirect TO: ' . $location->link->permalink . '?' . http_build_query($input));
            $input['allsegments'] = $location->link->permalink;

            return ['redirect' => $this->redirect->route(
                'search.parse',
                $input,
                301
            )];
        }

        $radius = $this->input->get('radius');
        if(!$radius) {
            $radius = $this->input->get('distance', $this->config->get('evercise.default_radius'));
        }

        $size = $this->session->get('PER_PAGE', $this->config->get('evercise.default_per_page'));


        if (!empty($area->min_radius) && str_replace('mi', '', $area->min_radius) > str_replace('mi', '', $radius)) {
            //  $radius = $area->min_radius;
        }


        $page = (!empty($input['page']) ? $input['page'] : 1);
        $sort = $this->getSort($area, (!empty($input['sort']) ? $input['sort'] : 'best'));
        $search = (!empty($input['search']) ? $input['search'] : '');

        $params = [
            'size' => $size,
            'venue_id' => (!empty($input['venue_id']) ? $input['venue_id'] : false),
            'from' => (($page - 1) * $size),
            'sort' => $sort,
            'radius' => (in_array(
                $radius,
                array_values($this->config->get('evercise.radius'))
            ) ? $radius : $this->config->get(
                'evercise.default_radius'
            )),
            'search' => $search
        ];


        if(!empty($input['featured'])) {
            $params['featured'] = true;
        }



        if(!empty($input['map_nw']) && !empty($input['map_se'])) {
            $params['bounds'] = [
                'top_left' => $input['map_nw'],
                'bottom_right' => $input['map_se']
            ];
        }

        $searchResults = $this->search->getResults($area, $params);




        $this->elastic->saveStats((!empty($user->id) ? $user->id : 0), $this->input->ip(), $area, $params,
            $searchResults->total);


        $data = [
            'area' => $area,
            'results' => $searchResults,
            'url' => $area->link->permalink,
            'size' => $size,
            'sort' => (!empty($input['sort']) ? $input['sort'] : 'best'),
            'venue_id' => (!empty($input['venue_id']) ? $input['venue_id'] : ''),
            'venue' => (!empty($input['venue_id']) ? Venue::find($input['venue_id'])->toArray() : ''),
            'radius' => $radius,
            'allowed_radius' => array_flip($this->config->get('evercise.radius')),
            'page' => $page,
            'search' => $search
        ];



        if($landing) {

            foreach($this->config->get('landing_pages') as $url => $params) {
                if(str_replace('/uk/london/', '', $url) == $landing) {
                    $item = $params;
                }
            }

            if(!empty($item)) {
                $data['landing'] = $item;
            }

        }


        return $data;
    }



    public function searchMap($area = false, $input = [], $user = false) {


        /**
         *
         * search
         * location
         * city
         * per_page
         * page
         * sort
         * from
         * distance
         * venue_id
         *
         * map_nw = [lat => '', lon => '']
         * map_se = [lat => '', lon => '']
         *
         *
         */

        $landing = false;
        if(!empty($input['landing'])) {
            $landing = $input['landing'];
            unset($input['landing']);
        }

        /** Clean up empty Arrays  */
        foreach ($input as $key => $val) {
            if (empty($val)) {
                unset($input[$key]);
            }
        }

        unset($input['area_id']);

        /** If Area is not a object lets add it to the database so we have it for later use  */
        if (!$area instanceof Place) {

            $this->log->info('Not a Place');
            if (!isset($input['location']) || empty($input['location'])) {
                $input['location'] = 'London';
            }
            if (!isset($input['city']) || empty($input['city'])) {
                $input['city'] = 'London';
            }
            $area = $this->place->getByLocation($input['location'], $input['city']);
        }

        $radius = $this->input->get('radius');
        if(!$radius) {
            $radius = $this->input->get('distance', $this->config->get('evercise.default_radius'));
        }

        $sort = $this->getSort($area, (!empty($input['sort']) ? $input['sort'] : 'best'));
        $search = (!empty($input['search']) ? $input['search'] : '');

        $params = [
            'size' => $this->config->get('evercise.max_display_map_results'),
            'from' => 0,
            'sort' => $sort,
            'radius' => '25mi',
            'search' => $search
        ];


        if(!empty($input['featured'])) {
            $params['featured'] = true;
        }


        if(!empty($input['map_nw']) && !empty($input['map_se'])) {
            $params['bounds'] = [
                'top_left' => $input['map_nw'],
                'bottom_right' => $input['map_se']
            ];
        }
        $searchResults = $this->search->getMapResults($area, $params);


        return $searchResults;


    }



    public function getClasses($params) {

        /*
         *
         * location = 'london';
         *
         */


        $location = $this->place->getByLocation((!empty($params['location']) ? $params['location'] : 'London'));
        $query = [
            'size'      => (!empty($params['size']) ? $params['size'] : $this->config->get('evercise.default_per_page')),
            'from'      =>(!empty($params['from']) ? $params['from'] : 0),
            'sort'      => $this->getSort($location, (!empty($params['sort']) ? $params['sort'] : 'nearme')),
            'radius'    => (!empty($params['radius']) ? $params['radius'] : $this->config->get('evercise.default_radius')),
            'search'    => (!empty($params['search']) ? $params['sort'] : ''),
            'featured'  => (isset($params['featured']) ? $params['featured'] : '')
        ];

        $searchResults = $this->search->getResults($location, $query);


        return $searchResults;

    }


    private function getSort($area, $sort = '')
    {

        $options = [
            'price_asc' => ['default_price' => 'asc'],
            'price_desc' => ['default_price' => 'desc'],
            'duration_asc' => ['default_duration' => 'asc'],
            'duration_desc' => ['default_duration' => 'desc'],
            'viewed_asc' => ['counter' => 'asc'],
            'viewed_desc' => ['counter' => 'desc'],
            'nearme' => [
                "_geo_distance" => [
                    'venue.location' => $this->elastic->getLocationHash($area->lat, $area->lng),
                    "order" => "asc",
                    "unit" => "mi"
                ]
            ]
        ];

        if (!empty($options[$sort])) {
            return $options[$sort];
        }

        return false;

    }


}