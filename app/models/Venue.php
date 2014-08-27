<?php

class Venue extends \Eloquent
{

    protected $fillable = array('id', 'user_id', 'name', 'address', 'town', 'postcode', 'lat', 'lng', 'image');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'venues';

    /**
     * @return VenuesController|\Illuminate\View\View
     */
    public static function usersVenues($id)
    {
        // list all venues belonging to this user
        $venues = static::where('user_id', $id)->lists('name', 'id');
        return View::make('venues.index')->with('venues', $venues);
    }

    /**
     * @return VenuesController|\Illuminate\View\View
     */
    public static function createNewVenue()
    {
        // create new vuewnue view with facilities
        $facilities = Facility::get();
        return View::make('venues.create')->with('facilities', $facilities);
    }

    /**
     * @return array
     */
    public static function storeNewVenue($inputs, $id)
    {

        Validator::extend('has_not', function ($attr, $value, $params) {
            return ValidationHelper::hasNotRegex($attr, $value, $params);
        });

        Validator::extend('has', function ($attr, $value, $params) {
            return ValidationHelper::hasRegex($attr, $value, $params);
        });

        // todo validation extends needs its own class

        $validator = Validator::make(
            $inputs,
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
        if ($validator->fails()) {
            $result = [
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            ];

        } else {
            $venue_name = $inputs['venue_name'];
            $address = $inputs['street'];
            $town = $inputs['city'];
            $postcode = $inputs['postcode'];
            $lat = $inputs['latbox'];
            $lng = $inputs['lngbox'];

            $facilities = isset($inputs['facilities_array']) ? $inputs['facilities_array'] : [];

            $venue = static::create([
                'user_id' => $id,
                'name' => $venue_name,
                'address' => $address,
                'town' => $town,
                'postcode' => $postcode,
                'lat' => $lat,
                'lng' => $lng
            ]);

            $venue->facilities()->sync($facilities); // Bang the id's of the facilities in venue_facility

            $result = [
                'venue_id' => $venue->id
            ];

        }
        return $result;
    }

    /**
     * @param $id
     * @return VenuesController|\Illuminate\View\View
     */
    public static function editUsersVenue($id)
    {
        $venue = static::find($id);

        $facilities = [];
        foreach ($venue->facilities as $facility) {
            $facilities[] = $facility->id;
        }

        return View::make('venues.edit_form')->with('venue', $venue)->with('selectedFacilities', $facilities);
    }



    public function evercisegroup()
    {
        return $this->hasMany('Evercisegroup');
    }


    public function Facilities()
    {
        return $this->belongsToMany('Facility', 'venue_facilities', 'venue_id', 'facility_id')->withTimestamps();
    }

    public function evercisesessions()
    {
        return $this->hasManyThrough('Evercisesession', 'Evercisegroup');
    }
}