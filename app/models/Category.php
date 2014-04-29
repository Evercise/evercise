<?php

class Category extends Eloquent {

	protected $fillable = array('id', 'name','description');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

}