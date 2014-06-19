<?php

class Sessionpayment extends \Eloquent {
	protected $fillable = ['user_id', 'evercisesession_id', 'total', 'total_after_fees', 'commission', 'processed'];

	
	public function user()
    {
        return $this->belongsTo('User');
    }

}

