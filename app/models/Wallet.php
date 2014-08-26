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

    public function deposit($amount, $sessionpayment_id = 0)
    {
        $this->transaction($amount, $sessionpayment_id);
    }

    public function withdraw($amount, $sessionpayment_id = 0)
    {
        $this->transaction(-$amount, $sessionpayment_id);
    }

    public function recordedSave(array $params)
    {
        //$transaction_amount = $params['balance'] - $params['previous_balance'];

        Wallethistory::create(
            [
                'user_id' => $params['user_id'],
                'transaction_amount' => $params['transaction_amount'],
                'new_balance' => $params['new_balance'],
                'sessionpayment_id' => $params['sessionpayment_id']
            ]
        );

        parent::save();

    }

    protected function transaction($amount, $sessionpayment_id)
    {

        $user_id = $this->attributes['user_id'];
        $this->attributes['balance'] = $this->attributes['balance'] + $amount;

        $this->save();

        Wallethistory::create(
            [
                'user_id' => $user_id,
                'sessionpayment_id' => $sessionpayment_id,
                'transaction_amount' => $amount,
                'new_balance' => $this->attributes['balance']
            ]
        );
    }

    public function updatePaypal($newPaypal)
    {
        $this->attributes['paypal'] = $newPaypal;
        $this->save();
    }


    public static function userWallet($user_id)
    {
        return Wallet::where('user_id', $user_id)->first();
    }

}
  