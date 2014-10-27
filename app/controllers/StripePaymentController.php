<?php

use Omnipay\Omnipay;

class StripePaymentController extends BaseController {

    

    /*
     * Create payment using credit card
     * url:payment/create
    */
    public function create()
    {
        

    }

    /*
     * Create payment using credit card
     * url:payment/create
    */
    public function store()
    {
        /* get session ids from Cart*/

        $cartRows = Cart::content();
        foreach($cartRows as $row)
        {
            array_push($sessionIds, $row->options->sessionId);
        }

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

        $amountToPay = SessionPayment::poundsToPennies($amountToPay);

        
        $token  = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = array();
            if (isset($_POST['stripeToken'])) {
                $token = $_POST['stripeToken'];
            } else {

                return Redirect::route('evercisegroups', [$evercisegroupId])
                    ->with('notification', 'There was a problem with processing your payment. Please try again.');
            }
        } // End of form submission conditional.

        

        try
        {
            $customer = Stripe_Customer::create(array(
                'email' => 'customer@example.com',
                'card'  => $token
            ));

            $charge = Stripe_Charge::create(array(
                'customer' => $customer->id,
                'amount'   => $amountToPay,
                'currency' => 'gbp'
            ));
        }
        catch(Stripe_CardError $e)
        {
                return Redirect::to('evercisegroups/'. $evercisegroupId)
                    ->with('errorNotification', $e->getMessage());
        }

        return Redirect::to('sessions/'.$evercisegroupId.'/pay')
            ->with('token',$token )
            ->with('transactionId', $charge['id'] )
            ->with('payerId',$customer->id )
            ->with('paymentMethod', 'stripe' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
     

      return 'show';

    }

    public function pay()
    {
        return View::make('payments.stripepay');
    }

    public function paid()
    {

    }

}