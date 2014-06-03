<?php

class Evercisesession extends \Eloquent {

	protected $fillable = array('evercisegroup_id', 'date_time', 'members', 'price', 'duration' ,'members_emailed');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evercisesessions';

	public function Sessionmembers()
    {
        return $this->hasMany('Sessionmember');
    }

	public function Evercisegroup()
    {
        return $this->belongsTo('Evercisegroup');
    }

    



}

 //select `users`.*, `sessionmembers`.`user_id` from `users` inner join `sessionmembers` on `sessionmembers`.`id` = `users`.`id` where `sessionmembers`.`user_id` in (?, ?, ?, ?, ?)