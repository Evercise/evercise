<?php

class CartController extends \BaseController
{
    public function getCart()
    {
        $data = EverciseCart::getCart();

        return View::make('v3.cart.checkout')
            ->with('data', $data);
    }
}