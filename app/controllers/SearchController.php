<?php


class SearchController extends \BaseController
{

    protected $evercisegroup;
    protected $sentry;
    protected $link;
    protected $input;
    protected $log;
    protected $place;
    protected $elastic;
    protected $search;

    public function __construct(
        Evercisegroup $evercisegroup,
        Sentry $sentry,
        Link $link,
        Illuminate\Http\Request $input,
        Illuminate\Log\Writer $log,
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

        $this->elastic = new Elastic($geotools::getFacadeRoot(), $this->evercisegroup, $elasticsearch::getFacadeRoot(), $this->log);
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
            if ($sentry->check() && $evercisegroup->user_id == $this->user->id
            ) // This Group belongs to this User/Trainer
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
        $link = $this->link->checkLink($all_segments);


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

        $input = $this->input->all();

        /** If Area is not a object lets add it to the database so we have it for later use  */
        if (!$area instanceof Place) {

            $this->log->info('NoT Place');
            if (!isset($input['location'])) {
                $input['location'] = 'London';
            }
            $location = $this->place->getByLocation($input['location']);

            unset($input['location']);
            /** We have save the location to the DB so we can redirect the user to the new URL now */

            $this->log->info('Redirect TO: ' . $location->link->permalink . '?' . http_build_query($input));
            $input['allsegments'] = $location->link->permalink;

            return Redirect::route(
                'search.parse',
                $input,
                301
            );


        }
        $params = [
            'page'   => $this->input->get('page', 1),
            'radius' => $this->input->get('radius', '1mi'),
            'search' => $this->input->get('search')
        ];


        $searchResults = $this->search->getResults($area, $params);


        echo "<pre>";
        print_r($searchResults);
        die();

        $perPage = 12;


        if ($page > count($allResults) or $page < 1) {
            $page = 1;
        }
        $offset = ($page * $perPage) - $perPage;
        $articles = array_slice($allResults, $offset, $perPage);
        $paginatedResults = Paginator::make($articles, count($allResults), $perPage);

        foreach ($allResults as $result) {
            unset($result['description']);
            unset($result['default_duration']);
            unset($result['published']);
            unset($result['created_at']);
            unset($result['updated_at']);
            unset($result['user']);
            unset($result['venue_id']);
            unset($result['title']);
            unset($result['gender']);
            $mapResult[] = $result->toJson();
        }

        //return json_encode($mapResult);


        return View::make('evercisegroups.search')
            ->with('places', json_encode($mapResult))
            ->with('evercisegroups', $paginatedResults);

        echo "<pre>";
        print_r($res);
        die();
        dd($res);
    }


}