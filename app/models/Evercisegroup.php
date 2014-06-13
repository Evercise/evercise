<?php

class Evercisegroup extends \Eloquent {

	protected $fillable = array('user_id', 'category_id', 'venue_id', 'name', 'title', 'description', 'address', 'town', 'postcode', 'lat', 'lng', 'image', 'capacity', 'default_duration', 'default_price', 'published');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evercisegroups';

	public function Evercisesession()
    {
        return $this->hasMany('Evercisesession');
    }

    public function venue()
    {
        return $this->belongsTo('Venue');
    }

    public function Sessionmember()
    {
        return $this->hasManyThrough('Sessionmember', 'Evercisesession');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function ratings()
    {
        return $this->hasMany('Rating');
    }
}