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

        $link = false;
        $fullLocation = $this->input->get('fullLocation', FALSE);


        if(!$fullLocation) {

            $link = $this->link->checkLink($all_segments, $this->input->get('area', FALSE));
        }



        if ($link && !$this->input->get('area', FALSE)) {

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
        } elseif ($link && $this->input->get('area', FALSE)) {
            $input = array_filter($this->input->except(['area', '_token', 'location']));
            $input['allsegments'] = $link->permalink;


            return $this->redirect->route(
                'search.parse',
                $input
            );

        } elseif (!$link && !$this->input->get('location', FALSE) && $all_segments != '') {

            $this->log->info('Somebody tried to access a missing URL ' . $this->input->url());

            $input['allsegments'] = '';

            $input = array_filter(array_except($input, ['area']));



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
     *
     * search
     * location
     * city
     * per_page
     * page
     * from
     * distance
     * venue_id
     *
     *
     * @return Response
     */
    public function search($area = FALSE)
    {
        $input = array_filter($this->input->all());



        $dates = $this->searchmodel->search($area, $input, $this->user, TRUE);

        $input['date'] = $this->searchmodel->getSearchDate($dates, $input);


        $results = $this->searchmodel->search($area, $input, $this->user);



        $results['selected_date'] = $input['date'];
        $results['available_dates'] = $dates;


        if (!empty($results['redirect'])) {

            return $results['redirect'];
        }


        $results['related_categories'] = \Subcategory::getRelatedFromSearch(!empty($input['search']) ? $input['search'] : FALSE);

        JavaScript::put(['results' => $results]);


        return View::make('v3.classes.discover.search')
            ->with($results);


    }


    public function getClasses($params)
    {

        return $this->searchmodel->getClasses($params);

    }


}