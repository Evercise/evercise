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
        $venue = Venue::find($id);

        $facilities = [];
        foreach ($venue->facilities as $facility) {
            $facilities[] = $facility->id;
        }

        return View::make('venues.edit_form')->with('venue', $venue)->with('selectedFacilities', $facilities);
    }


}