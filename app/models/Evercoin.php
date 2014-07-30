<?php

class Evercoin extends \Eloquent {
	protected $fillable = array('id', 'user_id', 'balance');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evercoins';
	

    public function deposit( $amount )
    {
    	$this->transaction($amount);
    }

    public function withdraw( $amount )
    {
    	$this->transaction(-$amount);
    }

	public static function poundsToEvercoins($amountInPounds)
	{
		return $amountInPounds * 1 / Config::get('values')['evercoin'];
	}
	public static function evercoinsToPounds($amountInEvercoins)
	{
		return $amountInEvercoins * Config::get('values')['evercoin'];
	}

    protected function transaction( $amount )
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