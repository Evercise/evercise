<?php


use Omnipay\Omnipay;

class PaymentController extends BaseController
{


    /**
     * Create payment using credit card
     * url:stripe
     *
     * After user enters payment details, Stripe directs back to '/stripe' (specified in the stripe JS button)
     * This function will specify the payment amount, and receive the token from Stripe.
     */
    public function processStripePaymentSessions()
    {


        $coupon = Session::get('coupon', FALSE);
        $cart = EverciseCart::getCart($coupon);
        $token = Input::get('stripeToken');


        /* Convert amount to pennies to be sent to Stripe */
        $amountInPennies = SessionPayment::poundsToPennies($cart['total']['final_cost']);


        if ($cart['total']['final_cost'] > 0) {
            try {
                $customer = Stripe_Customer::create([
                    'email' => $this->user->email,
                    'card'  => $token
                ]);

                $charge = Stripe_Charge::create([
                    'customer' => $customer->id,
                    'amount'   => $amountInPennies,
                    'currency' => 'gbp'
                ]);
            } catch (Stripe_CardError $e) {
                return Redirect::route('payment.error');
            }

        } else {
            $charge = ['id' => Str::random()];
        }

        $wallet = $this->user->getWallet();
        if ($cart['total']['from_wallet'] > 0) {
            $wallet->withdraw($cart['total']['from_wallet'], 'Part payment for classes', $this->user);
        }


        $coupon = Coupons::processCoupon($coupon, $this->user);


        $transactionId = $charge['id'];
        $confirm = $this->paid($token, $transactionId, 'stripe', $cart, $coupon);
        $res = [
            'confirm'      => $confirm,
            'cart'         => $cart,
            'payment_type' => 'stripe',
            'coupon'       => $coupon,
            'transaction'  => $transactionId,
            'user'         => $this->user,
            'balance'      => ($wallet ? $wallet->balance : 0),
        ];

        return Redirect::route('checkout.confirmation')->with('res', $res);
        //return View::make('v3.cart.confirmation', $res);
    }

    /**
     * Create payment using paypal
     * url:paypal
     *
     */
    public function requestPaypalPaymentSessions()
    {


        $coupon = Session::get('coupon', FALSE);
        $cart = EverciseCart::getCart($coupon);

        if ($cart['total']['final_cost'] > 0) {
            try {

                $gateway = Omnipay::create('PayPal_Express');
                $gateway->setUsername(getenv('PAYPAL_USER'));
                $gateway->setPassword(getenv('PAYPAL_PASS'));
                $gateway->setSignature(getenv('PAYPAL_SIGNATURE'));
                $gateway->setTestMode(getenv('PAYPAL_TESTMODE'));


                $products = $this->getProductsPaypal($cart);


                $response = $gateway->purchase(
                    [
                        'cancelUrl' => URL::route('payment.cancelled'),
                        'returnUrl' => URL::route('payment.process.paypal'),
                        'amount'    => round($cart['total']['final_cost'], 2),
                        'currency'  => 'GBP'
                    ]
                )->send();

                //FOR FUCKS SAKE!!! ->setItems($products)

                if ($response->isRedirect()) {
                    // redirect to offsite payment gateway
                    $response->redirect();
                } else {
                    // payment failed: display message to customer
                    echo $response->getMessage();
                }
            } catch (Exception $e) {
                return Redirect::route('payment.error');
            }

        } else {
            return Redirect::route('cart.checkout');
        }
    }

    public function processPaypalPaymentSessions()
    {
        $coupon = Session::get('coupon', FALSE);
        $cart = EverciseCart::getCart($coupon);

        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername(getenv('PAYPAL_USER'));
        $gateway->setPassword(getenv('PAYPAL_PASS'));
        $gateway->setSignature(getenv('PAYPAL_SIGNATURE'));
        $gateway->setTestMode(getenv('PAYPAL_TESTMODE'));
        try {
            $response = $gateway->completePurchase(
                [
                    'amount'      => $cart['total']['final_cost'],
                    'currency'    => 'GBP',
                    'Description' => 'Exercise Classes'
                ]
            )->send();
        } catch (Exception $e) {

            Log::error($e->getMessage());

            return Redirect::route('payment.error');
        }
        //return var_dump($response);

        if ($response->isSuccessful()) {
            $data = $response->getData(); // this is the raw response object

            if ($cart['total']['from_wallet'] > 0) {
                $wallet = $this->user->getWallet();
                $wallet->withdraw($cart['total']['from_wallet'], 'Part payment for classes', $this->user);
            }

            $coupon = Coupons::processCoupon($coupon, $this->user);


            $transactionId = $data['PAYMENTINFO_0_TRANSACTIONID'];
            $res = [
                'confirm'      => $this->paid($data['TOKEN'], $transactionId, 'paypal', $cart,
                    $coupon, $data['PAYMENTINFO_0_SECUREMERCHANTACCOUNTID']),
                'cart'         => $cart,
                'payment_type' => 'paypal',
                'coupon'       => $coupon,
                'transaction'  => $transactionId,
                'user'         => $this->user,
                'balance'      => $this->user->getWallet()->balance,
            ];

            return Redirect::route('checkout.confirmation')->with('res', $res);

        } else {
            Log::info($response->getMessage());

            return Redirect::route('payment.error')->with('error', $response->getMessage());
        }
    }

    public function processWalletPaymentSessions()
    {
        $coupon = Session::get('coupon', FALSE);
        $cart = EverciseCart::getCart($coupon);
        $token = 'w_' . Functions::randomPassword(8);
        $transactionId = $token;

        $wallet = $this->user->getWallet();
        $wallet->withdraw($cart['total']['from_wallet'], 'Full payment for classes', $this->user);

        $coupon = Coupons::processCoupon($coupon, $this->user);

        $res = [
            'confirm'      => $this->paid($token, $transactionId, 'stripe', $cart, $coupon),
            'cart'         => $cart,
            'payment_type' => 'wallet',
            'coupon'       => $coupon,
            'transaction'  => $transactionId,
            'user'         => $this->user,
            'balance'      => $wallet->balance,
        ];

        return Redirect::route('checkout.confirmation')->with('res', $res);
        //return View::make('v3.cart.confirmation', $res);
    }


    public function paymentCancelled()
    {


    }


    public function paymentError()
    {


    }


    public function requestPaypalPaymentTopUp()
    {

        $cartRowId = EverciseCart::instance('topup')->search(['id' => 'TOPUP'])[0];
        $cartRow = EverciseCart::instance('topup')->get($cartRowId);

        $amount = $cartRow['price'];

        if ($amount > 0) {
            try {

                $gateway = Omnipay::create('PayPal_Express');
                $gateway->setUsername(getenv('PAYPAL_USER'));
                $gateway->setPassword(getenv('PAYPAL_PASS'));
                $gateway->setSignature(getenv('PAYPAL_SIGNATURE'));
                $gateway->setTestMode(getenv('PAYPAL_TESTMODE'));


                $response = $gateway->purchase(
                    [
                        'cancelUrl' => URL::route('payment.cancelled'),
                        'returnUrl' => URL::route('payment.process.paypal.topup'),
                        'amount'    => number_format($amount, 2),
                        'currency'  => 'GBP'
                    ]
                )->send();

                //FOR FUCKS SAKE!!! ->setItems($products)

                if ($response->isRedirect()) {
                    // redirect to offsite payment gateway
                    $response->redirect();
                } else {
                    // payment failed: display message to customer
                    echo $response->getMessage();
                }
            } catch (Exception $e) {
                return Redirect::route('payment.error');
            }

        }
    }


    public function processPaypalPaymentTopUp()
    {
        $cartRowId = EverciseCart::instance('topup')->search(['id' => 'TOPUP'])[0];
        $cartRow = EverciseCart::instance('topup')->get($cartRowId);

        $amount = $cartRow['price'];

        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername(getenv('PAYPAL_USER'));
        $gateway->setPassword(getenv('PAYPAL_PASS'));
        $gateway->setSignature(getenv('PAYPAL_SIGNATURE'));
        $gateway->setTestMode(getenv('PAYPAL_TESTMODE'));
        try {
            $response = $gateway->completePurchase(
                [
                    'amount'      => number_format($amount, 2),
                    'currency'    => 'GBP',
                    'Description' => 'Wallet TopUp'
                ]
            )->send();
        } catch (Exception $e) {

            Log::error($e->getMessage());

            return Redirect::route('payment.error');
        }
        //return var_dump($response);

        if ($response->isSuccessful()) {

            $data = $response->getData(); // this is the raw response object


            $transactionId = $data['PAYMENTINFO_0_TRANSACTIONID'];


            $this->user->wallet->deposit($amount, 'Top up with Paypal', $this->user, 0, $data['TOKEN'], $transactionId,
                'paypal', 0);
            EverciseCart::clearTopup();


            $data = [
                'amount'        => $amount,
                'token'         => $data['TOKEN'],
                'transactionId' => $transactionId,
            ];

            return Redirect::to('topup_confirmation')
                ->with('topup_details', $data);

        } else {
            Log::info($response->getMessage());

            return Redirect::route('payment.error')->with('error', $response->getMessage());
        }


    }


    public function processStripePaymentTopup()
    {
        $cartRowId = EverciseCart::instance('topup')->search(['id' => 'TOPUP'])[0];
        $cartRow = EverciseCart::instance('topup')->get($cartRowId);

        $amount = $cartRow['price'];


        $token = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['stripeToken'])) {
                $token = $_POST['stripeToken'];
            } else {

                throw new \Exception('Could not find token');
            }
        }

        /* Convert amount to pennies to be sent to Stripe */
        $amountInPennies = SessionPayment::poundsToPennies($amount);

        try {
            $customer = Stripe_Customer::create([
                'email' => $this->user->email,
                'card'  => $token
            ]);

            $charge = Stripe_Charge::create([
                'customer' => $customer->id,
                'amount'   => $amountInPennies,
                'currency' => 'gbp'
            ]);
        } catch (Stripe_CardError $e) {
            return 'card error';
        }

        $transactionId = $charge['id'];
        $this->user->wallet->deposit($amount, 'top up with Stripe', $this->user, 0, $token, $transactionId, 'stripe',
            0);
        EverciseCart::clearTopup();


        $data = [
            'amount'        => $amount,
            'token'         => $token,
            'transactionId' => $transactionId,
        ];

        return Redirect::to('topup_confirmation')
            ->with('topup_details', $data);

    }


    /**
     * Actually add the user to the classes they have purchased, or credit their account with the package/top up.
     *
     * @param $token
     * @param $transactionId
     * @return \Illuminate\View\View
     */
    public function paid($token, $transactionId, $paymentMethod, $cart = [], $coupon = 0, $payer_id = 0)
    {


        $commission = ($this->user->custom_commission > 0 ? $this->user->custom_commission : Config::get('evercise.commission'));

        $transaction = Transactions::create(
            [
                'user_id'          => $this->user->id,
                'total'            => $cart['total']['final_cost'],
                'total_after_fees' => (($cart['total']['final_cost'] / 100) * (100 - $commission)),
                'coupon_id'        => $coupon,
                'commission'       => $commission,
                'token'            => $token,
                'transaction'      => $transactionId,
                'payment_method'   => $paymentMethod,
                'payer_id'         => $payer_id
            ]);

        /** Add Packages to DB */
        foreach ($cart['packages'] as $package) {

            $p = UserPackages::create([
                'status'     => 1,
                'package_id' => $package['id'],
                'user_id'    => $this->user->id
            ]);


            $item = new TransactionItems([
                'user_id'    => $this->user->id,
                'type'       => 'package',
                'package_id' => $p->id
            ]);

            $transaction->items()->save($item);
        }


        $trainer_notify = [];

        foreach ($cart['sessions'] as $session) {
            $evercisesession = Evercisesession::find($session['id']);

            try {
                $check = UserPackages::check($evercisesession, $this->user);


                $packageClass = UserPackageClasses::create([
                    'user_id'            => $this->user->id,
                    'evercisesession_id' => $session['id'],
                    'package_id'         => $check->id,
                    'status'             => 1
                ]);


                event('activity.user.package.used', [$this->user, $check, $evercisesession]);


            } catch (Exception $e) {
                /** No package available */
                Log::error($e->getMessage());
            }


            $created = Sessionmember::create(
                [
                    'user_id'            => $this->user->id,
                    'evercisesession_id' => $session['id'],
                    'token'              => $transaction->token,
                    'transaction_id'     => $transaction->transaction,
                    'payment_method'     => $paymentMethod
                ]
            );


            $session_payment = Sessionpayment::create(
                [
                    'user_id'            => $this->user->id,
                    'evercisesession_id' => $session['id'],
                    'total'              => $session['price'],
                    'total_after_fees'   => (($session['price'] / 100) * (100 - $commission)),
                    'commission'         => round($commission, 3),
                    'processed'          => 0
                ]
            );


            $item = new TransactionItems([
                'user_id'            => $this->user->id,
                'type'               => 'session',
                'evercisesession_id' => $created->id
            ]);

            $transaction->items()->save($item);


            $evercisegroup = $evercisesession->evercisegroup()->first();

            $trainer = $evercisegroup->user()->first();

            /**
             * $trainer_notify[$trainer->id][] = ['user' => $this->user, 'trainer' => $trainer, 'session' => $evercisesession];
             */

            event('session.joined', [$this->user, $trainer, $evercisesession, $evercisegroup, $transaction->id]);

        }

        /**
         * We should do something like this soon!!
         * Group all Trainer sessions that a single user has joined and send him a email
         *
         * foreach($trainer_notify as $trainer_id => $params) {
         * event('trainer.session.joined', [$params]);
         * }

         */
        //$token, $transactionId, $paymentMethod, $cart = [], $coupon = 0, $payer_id = 0
        event('user.cart.completed', [$this->user, $cart, $transaction]);

        EverciseCart::clearCart();
        //EverciseCart::clearWalletPayment();

        Session::forget('coupon');

        /* Empty cart */

        //EverciseCart::clearCart();

        return TRUE;
    }

    public function showConfirmation()
    {
        $res = Session::get('res');
        if ($res) {
            return View::make('v3.cart.confirmation', $res);
        } else {
            return Redirect::route('home');
        }
    }

    public function topupConfirmation()
    {
        /* Get topup details sent with redirect */
        $data = Session::get('topup_details');
        if (!$data)
            return Redirect::route('home');

        $balance = $this->user->getWallet()->getBalance();

        $data['balance'] = $balance;

        return View::make('v3.cart.topup_confirmation')
            ->with('data', $data);

    }

    /**
     * @param $cart
     * @return array
     */
    public function getProductsPaypal($cart)
    {
        $products = [];
        /** Add Packages to DB */
        foreach ($cart['packages'] as $package) {
            $products[] = ['name' => $package['name'], 'quantity' => 1, 'price' => round($package['price'], 2)];
        }

        foreach ($cart['sessions_grouped'] as $id => $session) {
            $class = Evercisegroup::find($session['evercisegroup_id']);
            $products[] = [
                'name'     => $class->name,
                'quantity' => $session['qty'],
                'price'    => round($session['price'], 2)
            ];
        }

        return $products;
    }

}
