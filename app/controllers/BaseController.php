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

        $this->user = false;


        $coupon = Session::get('coupon', false);
        $this->cart = EverciseCart::getCart($coupon);

        $this->cart_items = [];
        foreach($this->cart['sessions_grouped'] as $key_id => $val) {
            $this->cart_items[$key_id] = $val['qty'];
        }

        foreach($this->cart['packages'] as $key_id => $val) {
            $this->cart_items[$key_id] = 1;
        }



        View::share('cart_items', $this->cart_items);
        View::share('cart', View::make('v3.cart.dropdown')->with($this->cart)->render());



        if (Sentry::check()) {
            $this->user = Sentry::getUser();

            $userImage = $this->user->image ? (Config::get('evercise.upload_dir') . 'profiles' . '/' . $this->user->directory . '/' . $this->user->image) : 'img' . '/' . 'no-user-img.jpg';
            View::share('userImage', isset($userImage) ? $userImage : '');
            View::share('user', $this->user);
            View::share('newMessages', ['count' => Messages::unread($this->user->id), 'user' => Messages::getLastMessageDisplayName($this->user->id)] );

            $header = $this->setupHeader('user');
        } else {
            $header = $this->setupHeader('none');
        }
        if (Request::is('cart/*'))
        {
            $header = $this->setupHeader('cart');
        }


        View::share('header', $header);

        $version = include(base_path().'/.version.php');

        View::share('version', $version);


    }


    protected function setupHeader($user_type = 'none')
    {
        $browse = false;
        if (Request::is('uk/*'))
        {
            $browse = true;
        }

        switch ($user_type) {
            case 'none':
                return View::make('v3.layouts.navigation')->with('browse',$browse)->render();
                break;

            case 'user':
                return View::make('v3.layouts.navigation-user')->with('browse',$browse)->render();
                break;

            case 'cart':
                return View::make('v3.layouts.navigation-cart')->render();
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
     * @return bool
     */
    public function checkLogin()
    {
        return Sentry::check();
    }


}