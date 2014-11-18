<?php namespace ajax;

use Input, Response, Venue, Sentry, \widgets\LocationController;

class VenuesController extends AjaxBaseController{


    public function __construct()
    {
        parent::__construct();
        $this->user = Sentry::getUser();
    }

    /**
     * POST Params:
     * name
     * address
     * town
     * postcode
     * facilities_array (array of id's)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $inputs = Input::all();

        $address = $inputs['address'];
        $town = $inputs['town'];
        $postcode = $inputs['postcode'];

        $geo = LocationController::addressToGeo([ $address, $town, $postcode ]);

        $result = Venue::validateAndStore( $this->user->id, $inputs, $geo );
        return Response::json($result);
    }

    /**
     * POST Params:
     * name
     * address
     * town
     * postcode
     * facilities_array (array of id's)
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $result = Venue::find($id)->validateAndUpdate( Input::all() );

        return Response::json($result);
    }
}