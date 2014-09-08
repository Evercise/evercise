<?php


class SearchController extends \BaseController
{

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
        $link = Link::checkLink($all_segments);


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

        $input = Input::all();

        /** If Area is not a object lets add it to the database so we have it for later use  */
        if (!$area instanceof Place) {

            Log::info('NoT Place');
            if (!isset($input['location'])) {
                $input['location'] = 'London';
            }
            $location = Place::getByLocation($input['location']);

            unset($input['location']);
            //We have save the location to the DB so we can redirect the user to the new URL now

            Log::info('Redirect TO: ' . $location->link->permalink . '?' . http_build_query($input));
            $input['allsegments'] = $location->link->permalink;

            return Redirect::route(
                'search.parse',
                $input,
                301
            );


        }
        $params = [
            'page'     => Input::get('page', 1),
            'radius'   => Input::get('radius', 1),
            'category' => Input::get('category')
        ];


        return Search::newSearch($area, $params, $this->user);
    }


}