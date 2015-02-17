<?php

class Withdrawalrequest extends \Eloquent
{
    protected $fillable = ['user_id', 'transaction_amount', 'account', 'acc_type', 'processed'];

    protected $table = 'withdrawalrequests';

    /**
     * @param $inputs , $id
     * @return array
     */
    public static function createWithdrawelRequest($inputs, $id)
    {

        $withdrawalAmount = $inputs['withdrawal'];
        $paypal = $inputs['paypal'];

        $wallet = Wallet::where('user_id', $id)->first();

        $withdrawal = Withdrawalrequest::create(
            [
                'user_id' => $id,
                'transaction_amount' => $withdrawalAmount,
                'account' => $paypal,
                'acc_type' => 'paypal',
                'processed' => 0
            ]
        );

        if ($withdrawal) {

            $wallet->withdraw($withdrawalAmount, 'Withdrawal request', Sentry::getUser());

            $result =
                [
                    'callback' => 'openConfirmPopup',
                    'url' => route('trainers.edit.tab', [$id, 'wallet']),
                    'popup' => (string)(View::make('wallets.confirm')
                        ->with('withdrawal', $withdrawalAmount)
                        ->with('paypal', $paypal))
                ];


        } else {
            $result =
                [
                    'callback' => 'refreshpage'
                ];
        }

        return $result;


    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function markProcessed()
    {
        $this->attributes['processed'] = 1;
        $this->save();
    }

    public static function getPendingWithdrawals()
    {
        return Withdrawalrequest::where('processed', 0)->with('user')->get();
    }

    public static function getProcessedWithdrawals()
    {
        return Withdrawalrequest::where('processed', 1)->with('user')->get();
    }
}