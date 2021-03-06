<?php

class Wallet extends \Eloquent
{

    protected $fillable = ['id', 'user_id', 'balance', 'previous_balance'];

    protected $table = 'wallets';

    /**
     * checks if the withdrawel request is valid
     * @logs info:  valid request
     * @log notci: invalid request
     * @return array|\Illuminate\Http\JsonResponse
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    public static function validWithdrawalRequest($inputs, $id)
    {
        $validator = Validator::make(
            $inputs,
            [
                'withdrawal' => 'required|max:1000|min:1|numeric',
                'paypal' => 'required|max:255|min:5',
            ]
        );
        if ($validator->fails()) {
            $result = [
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            ];

            Log::notice('Invalid wthdrawal request, failed validation');
        } else {

            $wallet = static::where('user_id', $id)->first();

            $withdrawal = $inputs['withdrawal'];
            $paypal = $inputs['paypal'];

            if ($withdrawal <= $wallet->balance) {

                $result = [
                    'validation_failed' => 0,
                    'withdrawal' => $withdrawal,
                    'paypal' => $paypal
                ];

                Log::info('valid withdrawal request');

            } else {

                $result = [
                    'validation_failed' => 1,
                    'errors' => ['withdrawal' => 'You don`t have that much in your wallet. ']
                ];

                Log::notice('Invalid withdrawal request, not enough money in wallet');

            }

        }

        return $result;
    }

    /**
     * @return \Illuminate\Validation\Validator
     */
    public static function validPaypalUpdateRequest($inputs, $id)
    {
        $validator = Validator::make(
            $inputs,
            [
                'updatepaypal' => 'required|max:255|min:5|email',
            ]
        );

        if ($validator->fails()) {

            $result = [
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            ];

        } else {
            $paypal = $inputs['updatepaypal'];
            $wallet = static::userWallet($id);
            $wallet->updatePaypal($paypal);

            $result = [
                'callback' => 'gotoUrl',
                'url' => route('trainers.edit.tab', [$id, 'wallet']),
            ];
        }
        return $result;
    }

    public function deposit($amount, $description, $type = 'deposit', $sessionmember_id = 0, $token = 0, $transactionId = 0, $paymentMethod = 0, $payer_id = 0)
    {
        return $this->transaction($amount, $description, $type, $sessionmember_id, $token, $transactionId, $paymentMethod, $payer_id );

    }

    public function withdraw($amount, $description, $type = 'withdraw', $sessionmember_id = 0, $token = 0, $transactionId = 0, $paymentMethod = 0, $payer_id = 0)
    {
        return $this->transaction(-$amount, $description, $type, $sessionmember_id, $token, $transactionId, $paymentMethod, $payer_id);
    }


    protected function transaction($amount, $walletHistoryDescription, $type, $sessionmember_id = 0, $token = 0, $transactionId = 0, $paymentMethod = 0, $payer_id = 0)
    {
        $user_id = $this->attributes['user_id'];

        /*$transaction = Transactions::create(
            [
                'user_id'          => $user_id,
                'total'            => $amount,
                'total_after_fees' => $amount,
                'coupon_id'        => 0,
                'commission'       => 0,
                'token'            => $token,
                'transaction'      => $transactionId,
                'payment_method'   => $paymentMethod,
                'payer_id'         => $payer_id
            ]);*/

        $newBalance = $this->attributes['balance'] + $amount;

/*        if(!$type instanceof \User) {
            switch ($type) {
                case 'deposit':
                    event('user.topup.completed', [$this->user, $transaction, $newBalance]);
                    break;
                case 'withdraw':
                    event('user.withdraw.completed', [$this->user, $transaction, $newBalance]);
                    break;
                case 'referral':
                    event('user.referral.completed', [$this->user, $transaction, $newBalance]);
                    break;
                case 'referral_signup':
                    event('user.referral.signup', [$this->user, $transaction, $newBalance]);
                    break;
                case 'full_payment':

                    break;
                case 'part_payment':

                    break;
            }
        } else {
            Log::error('----- WE MISSED THIS ONE!!!!!!!-----');
            Log::error($type);
        }*/

        $user_id = $this->attributes['user_id'];
        $this->attributes['previous_balance'] = $this->attributes['balance'];
        $this->attributes['balance'] = $newBalance;

        $this->save();

        Wallethistory::create(
            [
                'user_id' => $user_id,
                'sessionmember_id' => $sessionmember_id,
                'transaction_amount' => $amount,
                'new_balance' => $this->attributes['balance'],
                'description' => $walletHistoryDescription,
            ]
        );

        return $newBalance;
    }

    public function recordedSave(array $params)
    {
        //$transaction_amount = $params['balance'] - $params['previous_balance'];

        Wallethistory::create(
            [
                'user_id' => $params['user_id'],
                'transaction_amount' => $params['transaction_amount'],
                'new_balance' => $params['new_balance'],
                'sessionmember_id' => $params['sessionmember_id'],
                'description' => $params['description'],
            ]
        );

        parent::save();

    }

    public function updatePaypal($newPaypal)
    {
        $this->attributes['paypal'] = $newPaypal;
        $this->save();
    }

    public function giveAmount($amount = 0, $type, $description = 0) {
        if(!$type || $amount == 0) return false;

        $newBalance = $this->attributes['balance'] + $amount;

        $transaction = Transactions::create(
            [
                'user_id'          => $this->user->id,
                'total'            => $amount,
                'total_after_fees' => $amount,
                'coupon_id'        => 0,
                'commission'       => 0,
                'token'            => 0,
                'transaction'      => 0,
                'payment_method'   => $type,
                'payer_id'         => 0
            ]);

        switch($type) {
            case 'referral_signup':
                event('user.referral.signup', [$this->user, $transaction, $newBalance]);
                $walletHistoryDescription = 'You received £'.$amount.' for referral sign up';
                break;
            case 'ppc_signup':
                event('user.ppc.signup', [$this->user, $transaction, 'ppcunique']);
                $walletHistoryDescription = 'You received £'.$amount.' for ppc sign up';
                break;
            case 'static_ppc_signup':
                event('user.ppc.signup', [$this->user, $transaction, 'ppcstatic', $description ]);
                $walletHistoryDescription = 'You received £'.$amount.' for ppc sign up';
                break;
            case 'referral':
                event('user.referral.completed', [$this->user, $transaction, $newBalance]);
                $walletHistoryDescription = 'You received £'.$amount.' for referring your friends';
                break;
            case 'profile':
                $walletHistoryDescription = 'You received £'.$amount.' for completing your profile';
                break;
            case 'facebook':
                $walletHistoryDescription = 'You received £'.$amount.' for connecting your Facebook account';
                break;
            case 'twitter':
                $walletHistoryDescription = 'You received £'.$amount.' for connecting your Twitter account';
                break;
            case 'review':
                $walletHistoryDescription = 'You received £'.$amount.' for writing a review';
                break;

            default:
                return false;
        }

        $this->deposit($amount, $walletHistoryDescription, $type);


        //event('milestone.completed', [$user, $type, $title, $walletHistoryDescription, $amount]);
    }


    public static function userWallet($user_id)
    {
        return Wallet::where('user_id', $user_id)->first();
    }

    public function getBalance()
    {
        return sprintf('%0.2f', $this->balance);
    }

    public static function createIfDoesntExist($user_id)
    {
        if (static::where('user_id', $user_id)->first())
            return false;

        $wallet = static::firstOrCreate([
            'user_id'=>$user_id,
            'balance'=>0,
            'previous_balance'=>0
        ]);

        return $wallet;
    }

}