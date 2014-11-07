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
        return $venues;
    }

    private static function validateInputs($inputs)
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
                'street' => 'required|min:2',
                'city' => 'required|min:2',
                'postcode' => 'required|has_not:special|has:letter,num|min:4',
            ],
            ['postcode.has_not' => 'Post code must not contain any special characters',
                'postcode.has' => 'Post code must contain letters and numbers'
            ]

        );

        return $validator;
    }

    /**
     * @return array
     */
    public static function validateAndStore($userId, $inputs)
    {
        $validator = static::validateInputs($inputs);

        if ($validator->fails()) {
            $result = [
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            ];

        } else {
            $venue_name = $inputs['name'];
            $address = $inputs['address'];
            $town = $inputs['town'];
            $postcode = $inputs['postcode'];

            $facilities = isset($inputs['facilities_array']) ? $inputs['facilities_array'] : [];

            $venue = static::create([
                'user_id' => $userId,
                'name' => $venue_name,
                'address' => $address,
                'town' => $town,
                'postcode' => $postcode,
            ]);

            $venue->facilities()->sync($facilities); // Bang the id's of the facilities in venue_facility

            $result = [
                'venue_id' => $venue->id
            ];

        }
        return $result;
    }

    public function validateAndUpdate($inputs)
    {
        $validator = static::validateInputs($inputs);

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

            $facilities = isset($inputs['facilities_array']) ? $inputs['facilities_array'] : [];

            $this->update([
                'name' => $venue_name,
                'address' => $address,
                'town' => $town,
                'postcode' => $postcode,
            ]);

            $this->facilities()->sync($facilities); // Bang the id's of the facilities in venue_facility

            $result = [
                'venue_id' => $this->id
            ];

        }
        return $result;
    }

    public function evercisegroup()
    {
        return $this->hasMany('Evercisegroup');
    }

    public function images()
    {
        return $this->hasMany('VenueImages');
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