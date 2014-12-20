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

        $result = Venue::validateAndStore( $this->user->id, $inputs, $geo, $this->user );
        return Response::json($result);
    }

    public function edit()
    {
        $venue = Venue::find(Input::get('venue_id'));

        $res = ['error' => true, 'message' => ''];

        if(!isset($venue->id)) {
            $res['message'] = 'Venue Does not Exist';
            return Response::json($res);
        }

        if($this->user->id != $venue->user_id) {

            $res['message'] = 'You dont have permissions to edit this class';
            return Response::json($res);
        }


        $res['error'] = 'false';
        $res['venue'] = $venue->toArray();
        $facilities = $venue->getFacilities();
        $amenities = $venue->getAmenities();
        foreach($facilities as $f) {
            $res['facilities'][] = [
                'id' => $f->id,
                'name' => $f->name,
                'image' => $f->image,
            ];
        }
        foreach($amenities as $f) {
            $res['amenities'][] = [
                'id' => $f->id,
                'name' => $f->name,
                'image' => $f->image,
            ];
        }


        return Response::json($res);
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
        $result = Venue::find($id)->validateAndUpdate( Input::all() , $this->user );

        return Response::json($result);
    }
}