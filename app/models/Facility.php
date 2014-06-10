<?php

class Facility extends Eloquent {

	protected $fillable = array('id', 'name', 'category', 'details', 'image');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'facilities';

	/**
	 * Concatenate name and title
	 *
	 * 
	*/
}