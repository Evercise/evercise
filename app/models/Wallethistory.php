<?php

class Wallethistory extends \Eloquent {
	protected $fillable = ['user_id', 'transaction_amount', 'new_balance', 'sessionmember_id', 'description'];

	protected $table = 'wallethistory';

	public function getTransactionAmount()
	{
		return '&pound;' . sprintf('%0.2f', $this->transaction_amount);
	}

}