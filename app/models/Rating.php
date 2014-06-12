<?php

class Rating extends \Eloquent {

	protected $fillable = [];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Ratings';

	public function user()
    {
        return $this->belongsTo('User' , 'user_id');
    }
}