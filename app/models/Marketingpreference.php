<?php

class Marketingpreference extends \Eloquent {

	protected $fillable = array('id', 'name','options');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'marketingpreferences';
}