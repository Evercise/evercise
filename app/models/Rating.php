<?php

class Rating extends \Eloquent {

	protected $fillable = array('id', 'user_id', 'sessionmember_id', 'session_id', 'evercisegroup_id', 'user_created_id', 'stars', 'comment');

	protected $table = 'ratings';

    /* the user this rating belongs to */
	public function user()
    {
        return $this->belongsTo('User' , 'user_id');
    }

    /* the user that rated this class */
    public function rator()
    {
        return $this->belongsTo('User' , 'user_created_id');
    }    

    public function evercisegroup()
    {
        return $this->belongsTo('evercisegroup' , 'evercisegroup_id');
    }
}