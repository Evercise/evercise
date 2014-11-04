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
    public function confirmStripePayment()
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

        /* Convert amount to pennies to be sent to Stripe */
        $amountInPennies = SessionPayment::poundsToPennies($cartData['total']);

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
            //return var_dump($charge['id']);

            $transactionId = $charge['id'];
        }
        catch(Stripe_CardError $e)
        {
                return Redirect::to('evercisegroups/'. $evercisegroupId)
                    ->with('errorNotification', $e->getMessage());
        }

        $this->paid($token, $transactionId);


        return View::make('v3.cart.confirmation')
            ->with('data', $cartData);

        //return 'token: '.$token.' . transaction id: '.$transactionId;

/*        return Redirect::to('sessions/'.$evercisegroupId.'/pay')
        ->with('token',$token )
        ->with('transactionId', $charge['id'] )
        ->with('payerId',$customer->id )
        ->with('paymentMethod', 'stripe' );*/
    }


    /**
     * Actually add the user to the classes they have purchased, or credit their account with the package/top up.
     *
     * @param $evercisegroupId
     * @return \Illuminate\View\View
     */
    public function paid($token, $transactionId)
    {
        /* Get evercisesession payment stuff from session, and delete it so it wont be used again. */
        $cartData = EverciseCart::getCart();
        $paymentMethod = 'stripe';

        /* Sort sessions into groups */
        $sessionsSortedByGroup = [];
        foreach($cartData['cartRows'] as $row)
        {
            if (isset($sessionsSortedByGroup[$row->options->evercisegroupId]))
                array_push( $sessionsSortedByGroup[$row->options->evercisegroupId], $row );
            else
                $sessionsSortedByGroup[$row->options->evercisegroupId] = [$row];
        }

        /* Add members to sessions */
        foreach($sessionsSortedByGroup as $evercisegroupId => $sessionsInSameGroup)
            Evercisesession::addSessionMember($evercisegroupId, $sessionsInSameGroup, $token, $transactionId, $paymentMethod, $cartData['total'], $this->user->id);

        /* Empty cart */
        EverciseCart::destroy();

        return true;

    }



}