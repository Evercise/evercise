<?php

class VenuesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
  		$venues = Venue::where('user_id', $this->user->id)->lists('name', 'id');
		return View::make('venues.index')->with('venues', $venues);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

  		$facilities = Facility::get();
		return View::make('venues.create')->with('facilities', $facilities);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		Validator::extend('has_not', function($attr, $value, $params) {
		    if (!count($params)) {
		        throw new \InvalidArgumentException('The has validation rule expects at least one parameter, 0 given.');
		    }
		    
		    foreach ($params as $param) {
		        switch ($param) {
		            case 'num':
		                $regex = '/\pN/';
		                break;
		            case 'letter':
		                $regex = '/\pL/';
		                break;
		            case 'lower':
		                $regex = '/\p{Ll}/';
		                break;
		            case 'upper':
		                $regex = '/\p{Lu}/';
		                break;
		            case 'special':
		                $regex = '/[\pP\pS]/';
		                break;
		            default:
		                $regex = $param;
		        }
		        
		        if (preg_match($regex, $value)) {
		            return false;
		        }
		    }
		    
		    return true;
		});

		Validator::extend('has', function($attr, $value, $params) {
		    if (!count($params)) {
		        throw new \InvalidArgumentException('The has validation rule expects at least one parameter, 0 given.');
		    }
		    
		    foreach ($params as $param) {
		        switch ($param) {
		            case 'num':
		                $regex = '/\pN/';
		                break;
		            case 'letter':
		                $regex = '/\pL/';
		                break;
		            case 'lower':
		                $regex = '/\p{Ll}/';
		                break;
		            case 'upper':
		                $regex = '/\p{Lu}/';
		                break;
		            case 'special':
		                $regex = '/[\pP\pS]/';
		                break;
		            default:
		                $regex = $param;
		        }
		        
		        if ( ! preg_match($regex, $value)) {
		            return false;
		        }
		    }
		    
		    return true;
		});

		// todo validation extends needs its own class

		$validator = Validator::make(
			Input::all(),
			[
			'venue_name' => 'required|max:45',
				'latbox' => 'required',
				'street' => 'required|min:2',
				'city' => 'required|min:2',
				'postcode' => 'required|has_not:special|has:letter,num|min:4',
			],
			['postcode.has_not' => 'Post code must not contain any special characters',
				'postcode.has' => 'Post code must contain letters and numbers'
			]
				
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

			$facilities = Input::get('facilities_array', []);

			$venue = Venue::create(['user_id' => $this->user->id, 'name' => $venue_name, 'address' => $address, 'town' => $town, 'postcode' => $postcode, 'lat' => $lat, 'lng' => $lng]);
			
			$venue->facilities()->sync($facilities); // Bang the id's of the facilities in venue_facility
		}

		return Response::json(['venue_id' => $venue->id]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$venue = Venue::find($id);

		$facilities = [];
		foreach($venue->facilities as $facility)
		{
			$facilities[] = $facility->id;
		}

		JavaScript::put(array('MapWidgetloadScript ' => 1 ));

		return View::make('venues.edit_form')->with('venue', $venue)->with('selectedFacilities', $facilities);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		$validator = Validator::make(
			Input::all(),
			[
			'venue_name' => 'required',
				'latbox' => 'required'
			]
				
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



			$facilities = Input::get('facilities_array') ? Input::get('facilities_array') : [];

			//return Response::json(['success' => $facilities]);

			$venue = Venue::find($id);

			$venue->update(['user_id' => $this->user->id, 'name' => $venue_name, 'address' => $address, 'town' => $town, 'postcode' => $postcode, 'lat' => $lat, 'lng' => $lng]);
			
			$venue->facilities()->sync($facilities); // Bang the id's of the facilities in venue_facility
		}

		return Response::json(['venue_id' => $venue->id]);
	}

}