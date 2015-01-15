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

        public function makeBookingHashes()
        {
            $hashes = [];
            foreach($this->items as $item)
            {
                $original_id = $this->id . $item->id;
                $hashes[$item->id] = base_convert($original_id, 10, 36);
            }
            return $hashes;
        }

        public function makeBookingHashBySession($sessionId)
        {
            $hashes = [];
            foreach($this->items as $item)
            {
                $original_id = $this->id . $item->id;

                if($item->sessionmember)
                    if($item->sessionmember->evercisesession_id == $sessionId)
                        $hashes[$item->id] = base_convert($original_id, 10, 36);
            }
            return $hashes;
        }

        public static function decodeBookingHash($hash)
        {
            $unhashed = base_convert($hash, 36, 10);
            $characters = str_split($unhashed);

            $transactionId = implode('', array_slice($characters, 0, 7));
            $itemId = implode('', array_slice($characters, 7));

            return [
                'transaction_id' => $transactionId,
                'item_id' => $itemId
            ];
        }
    }