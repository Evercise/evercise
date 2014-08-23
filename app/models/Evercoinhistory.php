<?php

/**
 * Class Evercoinhistory
 */
class Evercoinhistory extends \Eloquent
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'transaction_amount', 'new_balance'];

    /**
     * @var string
     */
    protected $table = 'evercoinhistory';
}