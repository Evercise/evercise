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

        if (Sentry::check()) {
            $this->user = Sentry::getUser();
            $userImage = $this->user->image ? (Config::get('evercise.upload_dir') . 'profiles' . '/' . $this->user->directory . '/' . $this->user->image) : 'img' . '/' . 'no-user-img.jpg';
            View::share('userImage', isset($userImage) ? $userImage : '');
            View::share('user', $this->user);
            $header = $this->setupHeader('user');
        } else {
            $header = $this->setupHeader('none');
        }

        $cart = new EverciseCart;

        View::share('cart', View::make('v3.cart.dropdown')->with($cart->getCart())->render() );

        View::share('header', $header);

        $version = include((php_sapi_name() === 'cli' ? './':'../').'.version.php');

        View::share('version', $version);

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
     * @return bool
     */
    public function checkLogin()
    {
        return Sentry::check();
    }


}