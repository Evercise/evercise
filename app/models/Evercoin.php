<?php

class Evercoin extends \Eloquent {
	protected $fillable = array('id', 'user_id', 'balance');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evercoins';

	/**
	 * Concatenate name and title
	 *
	 * 
	*/
}