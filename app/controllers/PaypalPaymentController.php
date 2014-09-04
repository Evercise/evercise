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
     $gateway->setUsername(getenv('PAYPAL_USER'));
     $gateway->setPassword(getenv('PAYPAL_PASS'));
     $gateway->setSignature(getenv('PAYPAL_SIGNATURE'));
     $gateway->setTestMode(getenv('PAYPAL_TESTMODE'));

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
        $gateway->setUsername('evercise.info_api1.gmail.com');
         $gateway->setPassword('H2HGKAYP5A38P7TJ');
         $gateway->setSignature('AiPC9BjkCyDFQXbSkoZcgqH3hpacArhVam-NDXjgAOd7UFYdySpW9nkW');
         $gateway->setTestMode(false);

        $response = $gateway->completePurchase(
                        array(
                            'amount' => $amountToPay,
                            'currency' => 'GBP',
                            'Description' => $evercisegroup->name
                        )
                )->send();

        if ($response->isSuccessful()) {
             $data = $response->getData(); // this is the raw response object

            //return var_dump($data);
            return Redirect::to('sessions/'.$evercisegroupId.'/pay')
                    ->with('token',$data['TOKEN'] )
                    ->with('transactionId',$data['PAYMENTINFO_0_TRANSACTIONID'] )
                    ->with('payerId',$data['PAYMENTINFO_0_SECUREMERCHANTACCOUNTID'] )
                    ->with('paymentMethod', 'PayPal_Express' );
            //return Redirect::action('SessionsController@payForSessions');
        }

       

    }

}