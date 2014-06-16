<?php

class Evercisesession extends \Eloquent {

	protected $fillable = array('evercisegroup_id', 'date_time', 'members', 'price', 'duration' ,'members_emailed');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evercisesessions';

	public function sessionmembers()
    {
        return $this->hasMany('Sessionmember');
    }

	public function evercisegroup()
    {
        return $this->belongsTo('Evercisegroup');
    }
    

	public function users()
	{
		return $this->belongsToMany('User', 'sessionmembers', 'evercisesession_id', 'user_id')->withPivot('id');
	}



}

 //select `users`.*, `sessionmembers`.`user_id` from `users` inner join `sessionmembers` on `sessionmembers`.`id` = `users`.`id` where `sessionmembers`.`user_id` in (?, ?, ?, ?, ?)