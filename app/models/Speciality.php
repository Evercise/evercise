<?php

class Speciality extends Eloquent {

	protected $fillable = array('id', 'name','titles');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'specialities';

}