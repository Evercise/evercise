<?php

class BaseController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */

    public $user;

    public function __construct()
    {

        $this->beforeFilter('csrf', array('on' => 'post'));

        if (Sentry::check()) {
            $this->user = Sentry::getUser();
            $userImage = $this->user->image ? ('profiles' . '/' . $this->user->directory . '/' . $this->user->image) : 'img' . '/' . 'no-user-img.jpg';
            View::share('userImage', isset($userImage) ? $userImage : '');
            View::share('user', $this->user);
            $header = $this->setupHeader('user');
        } else {
            $header = $this->setupHeader('none');
        }

        View::share('cart', $this->getCart());

        View::share('header', $header);

    }

    /**
     * @return $this
     *
     * Return Cart data formatted as an array
     */
    protected  function getCart()
    {

        $cartRows = Cart::content();
        $subTotal = Cart::total();
        $discount = 0;
        $total = ($subTotal / 100) * (100 - $discount);

        $data = [
            'discount'   => $discount,
            'subTotal'   => $subTotal,
            'total'      => $total,
            'cartRows'   => $cartRows,
        ];

        return View::make('v3.cart.dropdown')->with($data)->render();

    }

    protected function setupHeader($user_type = 'none')
    {

        switch ($user_type) {
            case 'none':
                return View::make('v3.layouts.navigation')->render();
                break;

            case 'user':
                return View::make('v3.layouts.navigation-user')->render();
                break;
        }

    }

    protected function setupLayout()
    {




        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }


    /**
     * Check if the user is logged in and redirect if needed
     *
     * @param bool $redirect
     * @return bool
     */
    public function checkLogin()
    {
        return Sentry::check();
    }


}