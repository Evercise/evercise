<?php

class User_has_marketingpreference extends \Eloquent {
	protected $fillable = array('user_id', 'marketingpreferences_id');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_has_marketingpreferences';
}