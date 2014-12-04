<?php

    class CartController extends \BaseController
    {
        public function getCart()
        {

            $coupon = Session::get('coupon', FALSE);

            $data = [
                'cart'           => EverciseCart::getCart($coupon),
            ];


            /** Figure out how the hell are we going to display the Cart */



            return View::make('v3.cart.checkout')
                ->with('data', $data);
        }


        public function checkout()
        {
            if(!Sentry::check()) {
                return Redirect::route('cart.guest');
            }

            $coupon = Session::get('coupon', FALSE);
            $data   = EverciseCart::getCart($coupon);

            $data['coupon']         = $coupon;
            $data['user']           = $this->user;

            return View::make('v3.cart.checkout', $data);

        }


        public function paymentError()
        {

            die('shit');
        }

    }