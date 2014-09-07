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

            if (!empty($input['location'])) {
                $location = Place::getByLocation($input['location']);

                unset($input['location']);
                //We have save the location to the DB so we can redirect the user to the new URL now
                
                Redirect::route('search.parse', $location . '/' . http_build_query($input), 301);

            }

        }


        dd($input);

        dd($area);

        /* check if search form posted otherwise set default for radius */
        $radius = Input::get('radius', 10);

        $category = Input::get('category');
        $locationString = Input::get('location');


        return Evercisegroup::doSearch(['address' => $locationString], $category, $radius, $this->user);
    }


}