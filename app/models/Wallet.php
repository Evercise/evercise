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

    public function deposit($amount, $description, $user, $sessionmember_id = 0, $token = 0, $transactionId = 0, $paymentMethod = 0, $payer_id = 0)
    {
        $this->transaction($amount, $description, $user, $sessionmember_id, $token, $transactionId, $paymentMethod, $payer_id, 'deposit');
    }

    public function withdraw($amount, $description, $user, $sessionmember_id = 0, $token = 0, $transactionId = 0, $paymentMethod = 0, $payer_id = 0)
    {
        $this->transaction(-$amount, $description, $user, $sessionmember_id, $token, $transactionId, $paymentMethod, $payer_id, 'withdraw');
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

    protected function transaction($amount, $description, $user, $sessionmember_id = 0, $token = 0, $transactionId = 0, $paymentMethod = 0, $payer_id = 0, $type = '' )
    {
        $transaction = Transactions::create(
            [
                'user_id'          => $user->id,
                'total'            => $amount,
                'total_after_fees' => $amount,
                'coupon_id'        => 0,
                'commission'       => 0,
                'token'            => $token,
                'transaction'      => $transactionId,
                'payment_method'   => $paymentMethod,
                'payer_id'         => $payer_id
            ]);

        $newBalance = $this->attributes['balance'] + $amount;

        switch($type) {
            case 'deposit':
                event('user.topup.completed', [$user, $transaction, $newBalance]);
                break;
            case 'withdraw':
                event('user.withdraw.completed', [$user, $transaction, $newBalance]);
                break;
        }
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
                'description' => $description,
            ]
        );
    }

    public function updatePaypal($newPaypal)
    {
        $this->attributes['paypal'] = $newPaypal;
        $this->save();
    }

    public function giveAmount($amount = 0, $type = false) {
        if(!$type || $amount == 0) return false;

        $user = Sentry::getUser();

        switch($type) {
            case 'referral_signup':
                $title = 'Milestone Completed';
                $description = 'You received £'.$amount.' for referral sign up';
                break;
            case 'ppc_signup':
                $title = 'Milestone Completed';
                $description = 'You received £'.$amount.' for ppc sign up';
                break;
            case 'referral':
                $title = 'Milestone Completed';
                $description = 'You received £'.$amount.' for referring your friends';
                break;
            case 'profile':
                $title = 'Milestone Completed';
                $description = 'You received £'.$amount.' for completing your profile';
                break;
            case 'facebook':
                $title = 'Milestone Completed';
                $description = 'You received £'.$amount.' for connecting your Facebook account';
                break;
            case 'twitter':
                $title = 'Milestone Completed';
                $description = 'You received £'.$amount.' for connecting your Twitter account';
                break;
            case 'review':
                $title = 'Milestone Completed';
                $description = 'You received £'.$amount.' for writing a review';
                break;

            default:
                return false;
        }

        $this->deposit($amount, $description, $user);

        event('milestone.completed', [$user, $type, $title, $description, $amount]);

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