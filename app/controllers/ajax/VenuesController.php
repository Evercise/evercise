<?php namespace ajax;

use Input, Response, Venue, Sentry;

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
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $result = Venue::validateAndStore( $this->user->id, Input::all() );
        return Response::json($result);
    }

    /**
     * POST Params:
     * name
     * address
     * town
     * postcode
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