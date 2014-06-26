<?php

class Evercoinhistory extends \Eloquent {
	protected $fillable = ['user_id', 'transaction_amount', 'new_balance'];

	protected $table = 'evercoinhistory';
}