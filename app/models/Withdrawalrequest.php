<?php

class Withdrawalrequest extends \Eloquent {
	protected $fillable = ['user_id', 'transaction_amount', 'account', 'acc_type', 'processed'];

	protected $table = 'withdrawalrequests';
}