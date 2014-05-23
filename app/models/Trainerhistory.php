<?php

class Trainerhistory extends \Eloquent {

	protected $fillable = array('user_id', 'message');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trainerhistory';
}