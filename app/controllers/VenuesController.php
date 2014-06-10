<?php

class VenuesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		JavaScript::put(array('initEverciseGroups ' => 1 ));
		JavaScript::put(array('MapWidgetloadScript ' => 1 ));
		return View::make('venues.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(
			Input::all(),
			array(
				'venue_name' => 'required'
			)
		);
		if($validator->fails()) {
			if(Request::ajax()) return Response::json(['validation_failed' => 1, 'errors' =>  $validator->errors()->toArray() ]);
	        else return Redirect::route('users.edit')->withErrors($validator)->withInput();
		}
		else{
			$venue_name = Input::get('venue_name');
			$address = Input::get('street');
			$town = Input::get('city');
			$postcode = Input::get('postcode');
			$lat = Input::get('latbox');
			$lng = Input::get('lngbox');

			$facilities = Input::get('facilities_array');
			//return Response::json(['success' => $facilities]);

			$venue = Venue::create(['user_id' => $this->user->id, 'name' => $venue_name, 'address' => $address, 'town' => $town, 'postcode' => $postcode, 'lat' => $lat, 'lng' => $lng]);
			/*foreach ($facilities as $facility)
			{
				$venue->facilities()->attach($facility);
			}*/
			$venue->facilities()->sync($facilities);
		}

		return Response::json(['success' => 'true']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}