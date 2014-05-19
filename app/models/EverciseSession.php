<?php

class EverciseSession extends \Eloquent {

	protected $fillable = array('evercisegroup_id', 'date_time', 'members', 'price', 'members_emailed');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sessions';

	public function sessionmembers()
    {
        return $this->hasMany('Sessionmember');
    }

	public function evercisegroup()
    {
        return $this->belongsTo('EverciseGroup');
    }
}