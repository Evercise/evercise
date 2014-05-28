<?php

class Speciality extends Eloquent {

	protected $fillable = array('id', 'name','titles');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'specialities';

	/**
	 * Concatenate name and title
	 *
	 * 
	*/

	public function pluckSpecialityName()
    {
        return $this->attributes['name'] . ' ' . $this->attributes['titles'];
    }

	public function Trainers()
    {
        return $this->belongsTo('Trainer');
    }

}