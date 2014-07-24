<?php

class Category extends Eloquent {

	protected $fillable = array('id', 'name','image');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

}