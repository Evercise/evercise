<?php

class CartController extends \BaseController
{
    public function getCart()
    {
        $data = [
            'cart' => EverciseCart::getCartContents('ABCD'),
            'wallet_payment' => EverciseCart::getWalletPayment(),
        ];



        /** Figure out how the hell are we going to display the Cart */




        return View::make('v3.cart.checkout')
            ->with('data', $data);
    }
}