<?php


class VenuesController extends \BaseController
{


    /**
     * @return \Illuminate\View\View|VenuesController
     */
    public function index()
    {
        return Venue::usersVenues(Sentry::getUser()->id);
    }


    /**
     * @return \Illuminate\View\View|VenuesController
     */
    public function create()
    {
        return Venue::createNewVenue();
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {

        $result = Venue::storeNewVenue(Input::all(), Sentry::getUser()->id);

        return Response::json($result);
    }


    /**
     * @param $id
     * @return \Illuminate\View\View|VenuesController
     */
    public function edit($id)
    {
        return Venue::editUsersVenue($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {

        $result = Venue::storeNewVenue(Input::all(), Sentry::getUser()->id);

        return Response::json($result);
    }


}