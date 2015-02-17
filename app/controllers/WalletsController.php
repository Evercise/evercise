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

        $result = Wallet::validWithdrawalRequest(Input::all(), $id);

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
     * @log info successful withdrawal request
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $valid_withrawal = Wallet::validWithdrawalRequest(Input::all(), $this->user->id);

        if ($valid_withrawal['validation_failed'] == 0) {
            $result = Withdrawalrequest::createWithdrawelRequest(Input::all(), $this->user->id);

            if ($result) {
                Log::info('successful withdrawal request');
                Event::fire('wallet.request', [$this->user, Input::all()]);
                return Response::json($result);
            }
        } else {
            return Response::json($valid_withrawal);
        }

    }

    /**
     * Update users paypal details
     *
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePaypal($userId)
    {
        Event::fire('wallet.updatePaypal', [$this->user, Input::all()]);
        return Response::json(Wallet::validPaypalUpdateRequest(Input::all(), $userId));
    }


}