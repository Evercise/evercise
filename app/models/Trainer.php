<?php

class Trainer extends \Eloquent {

	protected $fillable = array('user_id', 'bio', 'website', 'profession');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trainers';

	public function Users()
    {
        return $this->belongsTo('User');
    }
}