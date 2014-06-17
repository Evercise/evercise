<?php

class Venue extends \Eloquent {

	protected $fillable = array('id', 'user_id', 'name', 'address', 'town', 'postcode', 'lat', 'lng', 'image');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'venues';

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