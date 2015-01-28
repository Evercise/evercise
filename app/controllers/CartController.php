<?php

class CartController extends \BaseController
{

    /**
     * @var Packages
     */
    private $packages;

    public function __construct(Packages $packages)
    {

        $this->packages = $packages;
    }

    public function getCart()
    {

        $coupon = Session::get('coupon', FALSE);

        $data = [
            'cart' => EverciseCart::getCart($coupon),
        ];


        /** Figure out how the hell are we going to display the Cart */


        return View::make('v3.cart.checkout')
            ->with('data', $data);
    }


    public function checkout()
    {
        $coupon = Session::get('coupon', FALSE);
        $data = EverciseCart::getCart($coupon);

        if (empty($data['sessions_grouped']) && empty($data['packages']) && empty($data['sessions']))
            return Redirect::route('home');

        $packages = [];

        foreach ($this->packages->orderBy('classes', 'asc')->orderBy('price', 'asc')->get() as $package) {
            $packages[$package->style][] = $package;
        }

        $data['coupon'] = $coupon;
        $data['user'] = Sentry::getUser();
        $data['packages_available'] = $packages;
        $data['cart'] = View::make('v3.cart.dropdown')->with(EverciseCart::getCart())->render();

        return View::make('v3.cart.checkout', $data);

    }


    public function paymentError()
    {

        die('shit');
    }

}