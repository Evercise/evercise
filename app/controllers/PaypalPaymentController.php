<?php

use Omnipay\Omnipay;

class PaypalPaymentController extends BaseController {

    

    /*
     * Create payment using credit card
     * url:payment/create
    */
    public function create()
    {
        /* get session ids */

        $sessionIdsRaw = Input::get('session-ids');
        $sessionIds = json_decode(Input::get('session-ids'), true);
        Session::put('sessionIds', $sessionIds);

      //  return var_dump($sessionIds);
        /* get currnet user */
        $user = User::find($this->user->id);
        /* create confirmation view */
        $evercisegroupId = Input::get('evercisegroup-id');
        Session::put('evercisegroupId', $evercisegroupId);

        //return var_dump(Session::get('sessionIds'));

        $evercisegroup = Evercisegroup::with(array('evercisesession' => function($query) use (&$sessionIds)
        {

            $query->whereIn('id', $sessionIds);

        }), 'evercisesession')->find($evercisegroupId);

        //Make sure there is not already a matching entry in sessionmembers
        if(Sessionmember::where('user_id', $this->user->id)->whereIn('evercisesession_id', $sessionIds)->count())
        {
            return Response::json('USER HAS ALREADY JOINED SESSION');
        }


        $total = 0;
        $price = 0;
        foreach ($evercisegroup->evercisesession as $key => $value)
        {
            ++$total;
            $price = $price + $value->price;
        }

        $amountToPay = ( null !== Session::get('amountToPay')) ? Session::get('amountToPay') : $price;

        $evercoin = Evercoin::where('user_id', $this->user->id)->first();

        if ($amountToPay + Evercoin::evercoinsToPounds($evercoin->balance) < $price)
        {
            return Response::json(['message' => ' User has not got enough evercoins to make this transaction :'.$amountToPay]);
        }


     $gateway = Omnipay::create('PayPal_Express');
     $gateway->setUsername('fee_api1.evercise.com');
     $gateway->setPassword('1382538555');
     $gateway->setSignature('Aodo9BslGbWevZQXif8dMUdeGkPiAViLGU1nZKk2LGHUbAj0M5jbw84L');
     $gateway->setTestMode(true);

     $response = $gateway->purchase(
                array(
                    'cancelUrl' => URL::to('/'),
                    'returnUrl' => URL::to('payment', [$evercisegroupId]), 
                    'amount' => $amountToPay,
                    'currency' => 'GBP'
                )
        )->send();

        $response->redirect();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        /* get session ids */
        $sessionIds = Session::get('sessionIds');

        /* get currnet user */
        $user = User::find($this->user->id);
        /* create confirmation view */
        $evercisegroupId = $id;

        //return var_dump(Session::get('sessionIds'));

        $evercisegroup = Evercisegroup::with(array('evercisesession' => function($query) use (&$sessionIds)
        {

            $query->whereIn('id', $sessionIds);

        }), 'evercisesession')->find($evercisegroupId);

        //Make sure there is not already a matching entry in sessionmembers
        if(Sessionmember::where('user_id', $this->user->id)->whereIn('evercisesession_id', $sessionIds)->count())
        {
            return Response::json('USER HAS ALREADY JOINED SESSION');
        }


        $total = 0;
        $price = 0;
        foreach ($evercisegroup->evercisesession as $key => $value)
        {
            ++$total;
            $price = $price + $value->price;

        }

        $amountToPay = ( null !== Session::get('amountToPay')) ? Session::get('amountToPay') : $price;

        $evercoin = Evercoin::where('user_id', $this->user->id)->first();

        if ($amountToPay + Evercoin::evercoinsToPounds($evercoin->balance) < $price)
        {
            return Response::json(['message' => ' User has not got enough evercoins to make this transaction :'.$amountToPay]);
        }


        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('fee_api1.evercise.com');
        $gateway->setPassword('1382538555');
        $gateway->setSignature('Aodo9BslGbWevZQXif8dMUdeGkPiAViLGU1nZKk2LGHUbAj0M5jbw84L');
        $gateway->setTestMode(true);

        $response = $gateway->completePurchase(
                        array(
                            'amount' => $amountToPay,
                            'currency' => 'GBP',
                            'Description' => 'Test Purchase for a penny'
                        )
                )->send();

        if ($response->isSuccessful()) {
             $data = $response->getData(); // this is the raw response object

            //return var_dump($data);
            return Redirect::to('sessions/'.$evercisegroupId.'/pay')
                    ->with('paypalToken',$data['TOKEN'] )
                    ->with('paypalTransactionId',$data['PAYMENTINFO_0_TRANSACTIONID'] )
                    ->with('paypalPayerId',$data['PAYMENTINFO_0_SECUREMERCHANTACCOUNTID'] );
            //return Redirect::action('SessionsController@payForSessions');
        }

       

    }

}