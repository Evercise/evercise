<?php

class Rating extends \Eloquent {

	protected $fillable = array('id', 'user_id', 'sessionmember_id', 'session_id', 'evercisegroup_id', 'user_created_id', 'stars', 'comment');

	protected $table = 'ratings';

	public function user()
    {
        return $this->belongsTo('User' , 'user_id');
    }
}