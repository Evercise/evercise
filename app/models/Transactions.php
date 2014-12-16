<?php

    class Transactions extends Eloquent
    {

        protected $table = 'transactions';
        protected $fillable = [
            'id',
            'user_id',
            'total',
            'total_after_fees',
            'coupon_id',
            'commission',
            'processed',
            'token',
            'transaction',
            'payer_id',
            'payment_method'
        ];


        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function items()
        {
            return $this->hasMany('TransactionItems', 'transaction_id');
        }

        public function formattedDate()
        {
            return  date('M jS Y', strtotime($this->created_at));
        }
    }