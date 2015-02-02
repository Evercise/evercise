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
use Response;
use Sentry;
use Search;
use SearchModel;
use Elastic;

class SearchController extends AjaxBaseController
{

    private $evercisegroup;
    private $sentry;
    private $link;
    private $input;
    private $log;
    private $session;
    private $redirect;
    private $paginator;
    private $place;
    private $elastic;
    private $search;
    private $searchmodel;

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
        Place $place,
        SearchModel $searchModel
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

        $this->searchmodel = $searchModel;


        $this->user = Sentry::getUser();
    }


    /**
     * Parse All Params and forward it to the right function
     * @param array $all_segments
     */
    public function parseUrl($all_segments = '')
    {
        $link = $this->link->checkLink($all_segments, $this->input->get('area_id', FALSE));


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
        } elseif (!$link && !$this->input->get('location', FALSE) && $all_segments != '') {

            $this->log->info('Somebody tried to access a missing URL ' . $this->input->url());

            $input['allsegments'] = '';

            return $this->redirect->route(
                'search.parse',
                $input
            );
        }

        return $this->search();
    }


    public function parseMapUrl($all_segments = '')
    {
        $link = $this->link->checkLink($all_segments, $this->input->get('area_id', FALSE));


        if ($link) {

            switch ($link->type) {
                case 'AREA':
                case 'STATION':
                case 'POSTCODE':
                case 'ZIP':
                    return $this->searchMap($link->getArea);
                    break;
            }
        } elseif (!$link && !$this->input->get('location', FALSE) && $all_segments != '') {

            $this->log->info('Somebody tried to access a missing URL ' . $this->input->url());

            $input['allsegments'] = '';

            return $this->redirect->route(
                'search.parse',
                $input
            );
        }

        return $this->searchMap();
    }


    public function search($area = FALSE)
    {
        $input = array_filter($this->input->all());


        $dates = $this->searchmodel->search($area, $input, $this->user, TRUE);

        $search_date = array_keys($dates)[0];

        if (!empty($input['date']) && !empty($dates[$input['date']])) {
            $search_date = $input['date'];
        }


        $input['date'] = $search_date;


        $results = $this->searchmodel->search($area, $input, $this->user);


        $results['selected_date'] = $search_date;
        $results['available_dates'] = $dates;
        $results['related_categories'] = [
            'i',
            'will',
            'add',
            'more',
            'categories',
            'here',
            'when',
            'tris',
            'finishes',
            'the',
            'function'
        ];


        return Response::json($results);

    }

    public function searchMap($area = FALSE)
    {
        return $this->search($area);

    }

}