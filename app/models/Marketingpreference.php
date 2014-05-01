<?php

class Marketingpreference extends \Eloquent {

	protected $guarded = array('id', 'name','option');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'marketingpreferences';
}