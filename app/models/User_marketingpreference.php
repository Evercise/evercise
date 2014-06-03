<?php

class User_marketingpreference extends \Eloquent {
	protected $fillable = array('user_id', 'marketingpreference_id');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_marketingpreferences';
}