<?php

class CartController extends \BaseController
{
    public function getCart()
    {
        $data = [
            'cart' => EverciseCart::getCart(),
            'wallet_payment' => EverciseCart::getWalletPayment(),
        ];

        return View::make('v3.cart.checkout')
            ->with('data', $data);
    }
}