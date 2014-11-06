<?php


class VenuesController extends \BaseController
{


    /**
     * @return \Illuminate\View\View|VenuesController
     */
    public function index()
    {
        return Venue::usersVenues($this->user->id);
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

        $result = Venue::storeNewVenue(Input::all(), $this->user->id);

        return Response::json($result);
    }


}