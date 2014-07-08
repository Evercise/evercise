<?php

class Wallet extends \Eloquent {

	protected $fillable = ['id', 'user_id', 'balance', 'previous_balance'];

	protected $table = 'wallets';

    public function deposit( $amount, $sessionpayment_id=0 )
    {
    	$this->transaction($amount, $sessionpayment_id);
    }

    public function withdraw( $amount, $sessionpayment_id=0 )
    {
    	$this->transaction(-$amount, $sessionpayment_id);
    }

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
    protected function transaction( $amount, $sessionpayment_id )
    {
    	
    	$user_id = $this->attributes['user_id'];
    	$oldBalance = $this->attributes['balance'];
    	$newBalance = $oldBalance + $amount;
    	$this->attributes['balance'] = $newBalance;

    	$this->save();

		Wallethistory::create([
			'user_id'=>$user_id,
			'sessionpayment_id' => $sessionpayment_id,
			'transaction_amount'=>$amount,
			'new_balance' => $newBalance
		]);
	}
	public function updatePaypal($newPaypal)
	{
		$this->attributes['paypal'] = $newPaypal;
    	$this->save();
	}

}
  