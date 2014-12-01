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
            $cart   = EverciseCart::getCart($coupon);
            $token  = Input::get('stripeToken');


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

            if ($cart['total']['from_wallet'] > 0) {
                $wallet = $this->user->getWallet();
                $wallet->withdraw($cart['total']['from_wallet'], 'Part payment for classes');
            }


            $coupon = Coupons::processCoupon($coupon, $this->user);


            $transactionId = $charge['id'];
            $res           = [
                'confirm'      => $this->paid($token, $transactionId, 'stripe', $cart, $coupon),
                'cart'         => $cart,
                'payment_type' => 'stripe',
                'coupon'       => $coupon,
                'transaction'  => $transactionId,
                'user'         => $this->user
            ];

            return View::make('v3.cart.confirmation', $res);
        }



        public function processStripePaymentTopup()
        {
            $cartRowId = EverciseCart::instance('topup')->search(['id' => 'TOPUP'])[0];
            $cartRow   = EverciseCart::instance('topup')->get($cartRowId);

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
            $this->user->wallet->deposit($amount, 'top up with Stripe');
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
        public function paid($token, $transactionId, $paymentMethod, $cart = [], $coupon = 0)
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
                    'payment_method'   => $paymentMethod
                ]);

            /** Add Packages to DB */
            foreach ($cart['packages'] as $package) {

                $package = UserPackages::create([
                    'status'     => 1,
                    'package_id' => $package['id'],
                    'user_id'    => $this->user->id
                ]);


                $item = new TransactionItems([
                    'user_id'    => $this->user->id,
                    'type'       => 'package',
                    'package_id' => $package->id
                ]);

                $transaction->items()->save($item);
            }

            foreach ($cart['sessions'] as $session) {
                $evercisesession = Evercisesession::find($session['id']);

                try {
                    $check = UserPackages::check($evercisesession, $this->user);

                    $packageClass = new UserPackageClasses([
                        'user_id'            => $this->user->id,
                        'evercisesession_id' => $session['id'],
                        'status'             => 1
                    ]);

                    $check->package()->save($packageClass);

                    event('activity.user.package.used', [$this->user, $check, $package, $evercisesession]);


                } catch (Exception $e) {
                    /** No package available */
                }


                $created = Sessionmember::create(
                    [
                        'user_id'            => $this->user->id,
                        'evercisesession_id' => $session['id'],
                        'token'              => $transaction->token,
                        'transaction_id'     => $transaction->transaction,
                        'payment_method'     => 'stripe'
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



                $trainer = $evercisesession->evercisegroup()->first()->user()->first();
                event('trainer.class.joined', [$this->user, $trainer, $evercisesession]);
                event('user.class.joined', [$this->user, $evercisesession]);

            }


            event('user.cart.completed', [$this->user, $cart, $transaction]);
            event('activity.user.cart.completed', [$this->user, $cart, $transaction]);

            /* Empty cart */
            EverciseCart::clearCart();
            EverciseCart::clearWalletPayment();

            return TRUE;
        }

        public function sessionConfirmation()
        {
            /* Get cart data sent with redirect, as Cart has now been cleared */
            $cartData      = Session::get('cartData');
            $walletPayment = Session::get('walletPayment');

            $data = [
                'cartData'      => $cartData,
                'walletPayment' => $walletPayment,
            ];

            return View::make('v3.cart.confirmation')
                ->with('data', $data);

        }

        public function topupConfirmation()
        {
            /* Get topup details sent with redirect */
            $data = Session::get('topup_details');

            return View::make('v3.cart.topup_confirmation')
                ->with('data', $data);

        }


        public function processPaypalPaymentSessions()
        {


            $coupon = Session::get('coupon', FALSE);
            $cart   = EverciseCart::getCart($coupon);
            $token  = Input::get('stripeToken');


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

            if ($cart['total']['from_wallet'] > 0) {
                $wallet = $this->user->getWallet();
                $wallet->withdraw($cart['total']['from_wallet'], 'Part payment for classes');
            }


            Coupons::processCoupon($coupon, $this->user);


            $transactionId = $charge['id'];
            $res           = [
                'confirm' => $this->paid($token, $transactionId, 'stripe'),
                'cart'    => $cart
            ];

            return View::make('v3.cart.confirmation', $res);
        }


    }
