<?php

class Evercoin extends \Eloquent {
	protected $fillable = array('id', 'user_id', 'balance');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evercoins';
	private $evercoinValue = 0.01;


	public static function poundsToEvercoins($amountInPounds)
	{
		return $amountInPounds * 1 / $this->evercoinValue;
	}
	public static function evercoinsToPounds($amountInEvercoins)
	{
		return $amountInEvercoins * $this->evercoinValue;
	}

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

    public function deposit( $amount )
    {
    	$this->transaction($amount);
    }

    public function withdraw( $amount )
    {
    	$this->transaction(-$amount);
    }

    private function transaction( $amount )
    {
    	$user_id = $this->attributes['user_id'];
    	$oldBalance = $this->attributes['balance'];
    	$newBalance = $oldBalance + $amount;
    	$this->attributes['balance'] = $newBalance;

    	$this->save();

		Evercoinhistory::create([
			'user_id'=>$user_id,
			'transaction_amount'=>$amount,
			'new_balance' => $newBalance
		]);
    }
}