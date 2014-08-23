<?php

/**
 * Class Evercoin
 */
class Evercoin extends \Eloquent
{
    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'balance'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evercoins';


    /**
     * @param $amount
     */
    public function deposit($amount)
    {
        $this->transaction($amount);
    }

    /**
     * @param $amount
     */
    public function withdraw($amount)
    {
        $this->transaction(- $amount);
    }

    /**
     * Convert Pounds To Evercoins
     *
     * @param $amountInPounds
     * @return float
     */
    public static function poundsToEvercoins($amountInPounds)
    {
        return $amountInPounds * 1 / Config::get('values')['evercoin'];
    }

    /**
     * Convert Evercoins to Pounds
     *
     * @param $amountInEvercoins
     * @return mixed
     */
    public static function evercoinsToPounds($amountInEvercoins)
    {
        return $amountInEvercoins * Config::get('values')['evercoin'];
    }

    /**
     * Generate a new Transaction
     *
     * @param $amount
     */
    protected function transaction($amount)
    {
        $user_id = $this->attributes['user_id'];
        $oldBalance = $this->attributes['balance'];
        $newBalance = $oldBalance + $amount;
        $this->attributes['balance'] = $newBalance;

        $this->save();

        Evercoinhistory::create(
            [
                'user_id'            => $user_id,
                'transaction_amount' => $amount,
                'new_balance'        => $newBalance
            ]
        );
    }
}