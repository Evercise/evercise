<?php

class Venue extends \Eloquent {

	protected $fillable = array('id', 'name', 'address', 'town', 'postcode', 'lat', 'lng', 'image');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'venues';

	/**
	 * Concatenate name and title
	 *
	 * 
	*/
}