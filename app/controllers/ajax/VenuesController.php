<?php namespace ajax;

use Input, Response, Venue;

class VenuesController extends AjaxBaseController{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {

        $result = Venue::storeNewVenue(Input::all(), $this->user->id);

        return Response::json($result);
    }
} 