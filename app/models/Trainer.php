<?php

class Trainer extends \Eloquent {

	protected $fillable = array('user_id', 'bio', 'website', 'specialities_id', 'gender', 'profession');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trainers';

	public function User()
    {
        return $this->belongsTo('User');
    }

    public function speciality()
    //return $this;
    {
        return $this->hasOne('Speciality' , 'id', 'specialities_id');
    }

}