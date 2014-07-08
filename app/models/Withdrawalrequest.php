<?php

class Withdrawalrequest extends \Eloquent {
	protected $fillable = ['user_id', 'transaction_amount', 'account', 'acc_type', 'processed'];

	protected $table = 'withdrawalrequests';

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	public function markProcessed()
	{
		$this->attributes['processed'] = 1;
		$this->save();
	}
}