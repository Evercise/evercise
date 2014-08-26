<?php

class WalletsController extends \BaseController
{


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return View::make('wallets.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $result = Wallet::validWithdrawelRequest(Input::all(), $id);

        if ($result['validation_failed'] == 0) {
            return Response::json(
                [
                    'callback' => 'openPopup',
                    'popup' => (string)(View::make('wallets.create')->with('withdrawal', $result['withdrawal'])->with(
                        'paypal', $result['paypal']
                    ))
                ]
            );
        }

        return Response::json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $validator = Validator::make(
            Input::all(),
            [
                'withdrawal' => 'required|max:1000|min:1|numeric',
                'paypal' => 'required|max:255|min:5',
            ]
        );
        if ($validator->fails()) {

            $result = array(
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            );
        } else {
            $withdrawalAmount = Input::get('withdrawal');
            $paypal = Input::get('paypal');

            $wallet = Wallet::where('user_id', $this->user->id)->first();

            if ($withdrawalAmount > $wallet->balance) {
                /* test to see if user has enough in there wallet, they can only submit more by using the console,
                if they dont log them out and send them home */
                Sentry::logout();
                return Response::json(
                    [
                        'callback' => 'sendhome'
                    ]
                );

            }
            $withdrawal = Withdrawalrequest::create(
                [
                    'user_id' => $this->user->id,
                    'transaction_amount' => $withdrawalAmount,
                    'account' => $paypal,
                    'acc_type' => 'paypal',
                    'processed' => 0
                ]
            );

            if ($withdrawal) {

                $wallet->withdraw($withdrawalAmount);

                return Response::json(
                    [
                        'callback' => 'openConfirmPopup',
                        'url' => route('trainers.edit.tab', [$this->user->display_name, 'wallet']),
                        'popup' => (string)(View::make('wallets.confirm')->with(
                            'withdrawal',
                            $withdrawalAmount
                        )->with('paypal', $paypal))
                    ]
                );
            }

        }
        if (Request::ajax()) {
            return Response::json($result);
        } else {
            return Redirect::route('trainers.edit')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function updatePaypal($userId)
    {
        $validator = Validator::make(
            Input::all(),
            [
                'updatepaypal' => 'required|max:255|min:5|email',
            ]
        );
        if ($validator->fails()) {

            $result = array(
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            );
        } else {
            $paypal = Input::get('updatepaypal');
            $wallet = Wallet::userWallet($this->user->id);
            $wallet->updatePaypal($paypal);

            return Response::json(
                [
                    'callback' => 'gotoUrl',
                    'url' => route('trainers.edit.tab', [$this->user->display_name, 'wallet']),
                ]
            );
        }

        if (Request::ajax()) {
            return Response::json($result);
        } else {
            return Redirect::route('trainers.edit')
                ->withErrors($validator)
                ->withInput();
        }
    }


}