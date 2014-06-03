<?php

class Marketingpreference extends \Eloquent {

	protected $guarded = array('id', 'name','option');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'marketingpreferences';

	/*public function User_marketingpreferences()
    {
        return $this->belongsToMany('User', 'user_marketingpreferences', 'user_id', 'marketingpreferences_id');
    }*/


	public function users()
	{
		return $this->belongsToMany('User');
	}
}