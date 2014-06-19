<?php

class Wallethistory extends \Eloquent {
	protected $fillable = ['user_id', 'transaction_amount', 'new_balance', 'sessionpayment_id'];

	protected $table = 'wallethistory';
}