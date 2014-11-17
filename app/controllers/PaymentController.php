<?php

use Omnipay\Omnipay;

class PaymentController extends BaseController {


    /**
     * Create payment using credit card
     * url:stripe
     *
     * After user enters payment details, Stripe directs back to '/stripe' (specified in the stripe JS button)
     * This function will specify the payment amount, and receive the token from Stripe.
    */
    public function processStripePaymentSessions()
    {

        /* get Cart data */
        $cartData = EverciseCart::getCart();
        $cartRows = $cartData['cartRows'];

        /* get session ids from Cart*/
        $sessionIds = [];
        $sessionPrices = [];
        foreach($cartRows as $row) {
            array_push($sessionIds, $row->options->sessionId);
            $sessionPrices[$row->options->sessionId] = ['price' => $row->price, 'qty' => $row->qty];
        }

        //return $cartRows;

        /* verify price */
        $sessions = Evercisesession::whereIn('id', $sessionIds)->get();
        $sumOfSessionPrices = 0;
        foreach($sessions as $session) {
            if($sessionPrices[$session->id]['price'] != $session->price)
                throw new \Exception('Price of row does not match');

            $sumOfSessionPrices += ($session->price * $sessionPrices[$session->id]['qty']);
        }
        if( (string)$sumOfSessionPrices != (string)$cartData['total'] )
            throw new \Exception('Total price does not match: '.$sumOfSessionPrices .' != '. $cartData['total']);

        /* Make sure there is not already a matching entry in sessionmembers */
/*
 * Actually, we will allow multiple entries in sessionmembers, as a user can buy more than one ticket.
         if(Sessionmember::where('user_id', $this->user->id)->whereIn('evercisesession_id', $sessionIds)->count())
            throw new \Exception('User has already joined session');
*/


        $token  = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['stripeToken'])) {
                $token = $_POST['stripeToken'];
            } else {

                throw new \Exception('Could not find token');
            }
        }

        $walletPayment = EverciseCart::getWalletPayment();

        $totalToPay = $cartData['total'] - $walletPayment;

        /* Convert amount to pennies to be sent to Stripe */
        $amountInPennies = SessionPayment::poundsToPennies($totalToPay);

        try
        {
            $customer = Stripe_Customer::create([
                'email' => $this->user->email,
                'card'  => $token
            ]);

            $charge = Stripe_Charge::create([
                'customer' => $customer->id,
                'amount'   => $amountInPennies,
                'currency' => 'gbp'
            ]);
        }
        catch(Stripe_CardError $e)
        {
            return 'card error';
        }

        $transactionId = $charge['id'];
        $this->paid($token, $transactionId);


        return Redirect::to('payment_confirmation')
            ->with('cartData', $cartData )
            ->with('walletPayment', $walletPayment );
/*            ->with('token',$token )
            ->with('transactionId', $charge['id'] )
            ->with('payerId',$customer->id )
            ->with('paymentMethod', 'stripe' )*/
    }

    public function processStripePaymentTopup()
    {
        $cartRowId = EverciseCart::instance('topup')->search(['id' => 'TOPUP'])[0];
        $cartRow = EverciseCart::instance('topup')->get($cartRowId);

        $amount = $cartRow['price'];

        $token  = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['stripeToken'])) {
                $token = $_POST['stripeToken'];
            } else {

                throw new \Exception('Could not find token');
            }
        }

        /* Convert amount to pennies to be sent to Stripe */
        $amountInPennies = SessionPayment::poundsToPennies($amount);

        try
        {
            $customer = Stripe_Customer::create(array(
                'email' => $this->user->email,
                'card'  => $token
            ));

            $charge = Stripe_Charge::create(array(
                'customer' => $customer->id,
                'amount'   => $amountInPennies,
                'currency' => 'gbp'
            ));
        }
        catch(Stripe_CardError $e)
        {
            return 'card error';
        }

        $transactionId = $charge['id'];
        $this->user->wallet->deposit($amount, 'top up with Stripe');
        EverciseCart::clearTopup();


        $data = [
            'amount' => $amount,
            'token' => $token,
            'transactionId' => $transactionId,
        ];

        return Redirect::to('topup_confirmation')
            ->with('topup_details', $data );

    }


    /**
     * Actually add the user to the classes they have purchased, or credit their account with the package/top up.
     *
     * @param $token
     * @param $transactionId
     * @return \Illuminate\View\View
     */
    public function paid($token, $transactionId)
    {
        /* Get evercisesession payment stuff from Cart, and delete it so it wont be used again. */
        $cartData = EverciseCart::getCart();
        $paymentMethod = 'stripe';

        /* Sort sessions into groups */
        $sessionsSortedByGroup = [];
        foreach($cartData['cartRows'] as $row)
        {
            for($i=0; $i<$row->qty; $i++)
            {
                if (isset($sessionsSortedByGroup[$row->options->evercisegroupId]))
                    array_push($sessionsSortedByGroup[$row->options->evercisegroupId], $row);
                else
                    $sessionsSortedByGroup[$row->options->evercisegroupId] = [$row];
            }
        }

        /* Add members to sessions */
        foreach($sessionsSortedByGroup as $evercisegroupId => $sessionsInSameGroup)
            Evercisesession::addSessionMember($evercisegroupId, $sessionsInSameGroup, $token, $transactionId, $paymentMethod, $cartData['total'], $this->user);

        /* Empty cart */
        EverciseCart::destroy();
        EverciseCart::clearWalletPayment();

        return true;
    }

    public function conftest()
    {
        $this->user->sessions()->attach(['303', '303'], ['token' => 'double', 'transaction_id' =>  'action', 'payer_id' => $this->user->id, 'payment_method' => 'fake']);

        $cartData = EverciseCart::getCart();
        return View::make('v3.cart.confirmation')
            ->with('data', $cartData);

    }

    public function sessionConfirmation()
    {
        /* Get cart data sent with redirect, as Cart has now been cleared */
        $cartData = Session::get('cartData');
        $walletPayment = Session::get('walletPayment');

        return View::make('v3.cart.confirmation')
            ->with('data', $cartData)
            ->with('walletPayment', $walletPayment);

    }

    public function topupConfirmation()
    {
        /* Get topup details sent with redirect */
        $data = Session::get('topup_details');

        return View::make('v3.cart.topup_confirmation')
            ->with('data', $data);

    }



}