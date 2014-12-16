<?php

class TransactionItems extends Eloquent
{

    protected $table = 'transaction_items';
    protected $fillable = ['id', 'user_id', 'transaction_id', 'type', 'evercisesession_id', 'package_id', 'amount'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction()
    {
        return $this->belongsTo('Transactions', 'transaction_id');
    }

    public function session()
    {
        return $this->belongsTo('Evercisesession', 'evercisesession_id');
    }

    public function package()
    {
        return $this->belongsTo('Package', 'evercisesession_id');
    }

}