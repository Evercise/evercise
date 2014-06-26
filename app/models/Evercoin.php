<?php

class Evercoin extends \Eloquent {
	protected $fillable = array('id', 'user_id', 'balance');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evercoins';


    public function recordedSave(array $params)
    {
    	//$transaction_amount = $params['balance'] - $params['previous_balance'];
    	
		Evercoinhistory::create([
			'user_id'=>$params['user_id'],
			'transaction_amount'=>$params['transaction_amount'],
			'new_balance' => $params['new_balance']
		]);

   		parent::save();

    }
}