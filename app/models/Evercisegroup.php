<?php

class Evercisegroup extends \Eloquent {

	protected $fillable = array('user_id', 'category_id', 'name', 'category_id', 'description', 'duration', 'maxsize', 'price', 'customurl', 'address', 'town', 'postcode', 'lat', 'long', 'image', 'capacity', 'default_duration', 'default_price', 'published');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evercisegroups';

	public function EverciseSession()
    {
        return $this->hasMany('EverciseSession');
    }
}