<?php

    class CartController extends \BaseController
    {
        public function getCart()
        {

            $coupon = Session::get('coupon', FALSE);

            $data = [
                'cart'           => EverciseCart::getCart($coupon),
                'wallet_payment' => EverciseCart::getWalletPayment(),
            ];


            /** Figure out how the hell are we going to display the Cart */


            return View::make('v3.cart.checkout')
                ->with('data', $data);
        }


        public function checkout()
        {


            $coupon = Session::get('coupon', FALSE);
            $data   = EverciseCart::getCart($coupon);

            $data['coupon']         = $coupon;
            $data['wallet_payment'] = EverciseCart::getWalletPayment();
            $data['user']           = $this->user;

            //JavaScript::put(['viewPrice' => SessionPayment::poundsToPennies($data['total']['final_cost']) ]);

            return View::make('v3.cart.checkout', $data);

        }


        public function paymentError()
        {

            die('shit');
        }

    }