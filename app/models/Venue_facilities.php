<?php

class Venue extends \Eloquent {

	protected $fillable = array('venue_id', 'facility_id');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'venue_facilities';

	/**
	 * Concatenate name and title
	 *
	 * 
	*/
}