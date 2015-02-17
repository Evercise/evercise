<?php

class TransactionItems extends Eloquent
{

    protected $table = 'transaction_items';
    protected $fillable = ['id', 'user_id', 'transaction_id', 'type', 'sessionmember_id', 'package_id', 'amount', 'name', 'final_price'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction()
    {
        return $this->belongsTo('Transactions', 'transaction_id');
    }

    public function sessionmember()
    {
        return $this->belongsTo('Sessionmember', 'sessionmember_id');
    }

    public function package()
    {
        return $this->belongsTo('Packages', 'package_id');
    }

}