<?php

class Wallet extends \Eloquent {

	protected $fillable = ['id', 'user_id', 'balance', 'previous_balance'];

	protected $table = 'wallets';

    public function recordedSave(array $params)
    {
    	//$transaction_amount = $params['balance'] - $params['previous_balance'];
    	
		Wallethistory::create([
			'user_id'=>$params['user_id'],
			'transaction_amount'=>$params['transaction_amount'],
			'new_balance' => $params['new_balance'],
			'sessionpayment_id' => $params['sessionpayment_id']
		]);

   		parent::save();

    }
}