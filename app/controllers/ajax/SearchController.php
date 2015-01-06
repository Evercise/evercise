<?php namespace ajax;

use Es;
use Evercisegroup;
use Geotools;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Log\Writer;
use Illuminate\Pagination\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Session\Store;
use Link;
use Place;
use Sentry;

class SearchController extends AjaxBaseController {

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
        Request $input,
        Writer $log,
        Store $session,
        Redirector $redirect,
        Factory $paginator,
        Repository $config,
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
                case 'POSTCODE':
                case 'ZIP':
                    return $this->search($link->getArea);
                    break;
                case 'CLASS':
                    return $this->show($link->getClass);
                    break;
            }
        } elseif (!$link && !$this->input->get('location', false) && $all_segments != '') {

            $this->log->info('Somebody tried to access a missing URL ' . $this->input->url());

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


            if (is_null($location)) {

                $this->log->info('Address ERROR: ' . $input['location'] . '?' . http_build_query($input));

                $input['allsegments'] = '';
                unset($input['location']);

                return $this->redirect->route(
                    'search.parse',
                    $input,
                    301
                );
            } else {
                unset($input['location']);
            }

            /** We have save the location to the DB so we can redirect the user to the new URL now */

            $this->log->info('Redirect TO: ' . $location->link->permalink . '?' . http_build_query($input));
            $input['allsegments'] = $location->link->permalink;

            return $this->redirect->route(
                'search.parse',
                $input,
                301
            );
        }

        $radius = $this->input->get('radius');
        if(!$radius) {
            $radius = $this->input->get('distance', $this->config->get('evercise.default_radius'));
        }

        $size = $this->session->get('PER_PAGE', $this->config->get('evercise.default_per_page'));


        if (!empty($area->min_radius) && str_replace('mi', '', $area->min_radius) > str_replace('mi', '', $radius)) {
            //  $radius = $area->min_radius;
        }

        $page = $this->input->get('page', 1);
        $sort = $this->getSort($area);
        $search = $this->input->get('search');

        $params = [
            'size' => $size,
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

        $searchResults = $this->search->getResults($area, $params);



        /* Overide $params arr so it will show the map results only */
        $params['size'] = $this->config->get('evercise.max_display_map_results');
        $params['from'] = 0;
        $map_search = $this->search->getResults($area, $params);
        $mapResults = $this->search->cleanMapResults($map_search);

        //Log Stats
        $this->elastic->saveStats((!empty($this->user->id) ? $this->user->id : 0), $this->input->ip(), $area, $params,
            $searchResults->total);

        $paginatedResults = $this->paginator->make($searchResults->hits, $searchResults->total, $size);


        $data = [
            'area' => $area,
            'places' => json_encode($mapResults),
            'evercisegroups' => $paginatedResults,
            'radius' => $radius,
            'allowed_radius' => array_flip($this->config->get('evercise.radius')),
            'page' => $page,
            'search' => $search
        ];



    }

    private function getSort($area, $sort = '')
    {
        $sort = $this->input->get('sort', $sort);

        $options = [
            'price_asc' => ['default_price' => 'asc'],
            'price_desc' => ['default_price' => 'desc'],
            'duration_asc' => ['duration_price' => 'asc'],
            'duration_desc' => ['duration_price' => 'desc'],
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