<?php


class UsersController extends \BaseController
{


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return Redirect::route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create($redirect = null)
    {


        $referralCode = Referral::checkReferralCode(Session::get('referralCode'));
        $ppcCode = Landing::checkLandingCode(Session::get('ppcCode'));
        $email = Session::get('email');

        return View::make('users.register')
            ->with('referralCode', $referralCode)
            ->with('redirect', $redirect)
            ->with('ppcCode', $ppcCode)
            ->with('email', $email);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $password_validation = User::validUserSignup(Input::all());

        if ($password_validation['validation_failed'] != 0) {
            return Response::json(
                [
                    'callback' => 'validationFailed',
                    'errors' => $password_validation['errors']
                ]
            );
        }
        // register user and add to user group
        $user = User::registerUser(Input::all());

        if( ! $user->id)
        {
            return Response::json(
                [
                    'callback' => 'validationFailed',
                    'errors' => $user->getErrors()
                ]
            );
        }
        else
        {
            // add user to the user group
            UserHelper::addToUserGroup($user);

            // create user defualts
            UserHelper::generateUserDefaults($user->id);

            // check for a referral code
            UserHelper::checkReferalCode(Session::get('referralCode'), $user->id);

            // check if user signed up from a landing page
            UserHelper::checkLandingCode(Session::get('ppcCode'), $user->id);

            Session::forget('email');

            User::makeUserDir($user);

            // check for newsletter and if so add to mailchimp

            $newsletter = Input::get('userNewsletter');
            if (!empty($newsletter)) {
                User::subscribeMailchimpNewsletter(
                    Config::get('mailchimp')['newsletter'],
                    $user->email,
                    $user->first_name,
                    $user->last_name
                );
            }

            Sentry::login($user, true);

            Event::fire('user.registered', [$user]);

            if (Input::has('redirect')) {
                return Response::json(
                    [
                        'callback' => 'gotoUrl',
                        'url'      => route(Input::get('redirect'))
                    ]
                );
            } else {

                User::sendWelcomeEmail($user);

                return Response::json(
                    [
                        'callback' => 'gotoUrl',
                        'url'      => route('users.edit.tab', [$user->id, 'evercoins'])
                    ]
                );

            }
        }


    }

    public function fb_login($redirect_url = null)
    {

        $getUser = User::getFacebookUser($redirect_url);

        $me = $getUser['user_profile'];


        if (empty($me)) {
            return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
        }


        $inputs = [];
        $inputs['check_display_name'] = str_replace(' ', '_', $me['name']);
        $inputs['display_name'] = UserHelper::fbCheckForUserNameAndIncrement($inputs);
        $inputs['first_name'] = $me['first_name'];
        $inputs['last_name'] = $me['first_name'];
        $inputs['dob'] = isset($me['birthday']) ? new DateTime($me['birthday']) : null;
        $inputs['dob'] = $inputs['dob']->format('Y-m-d');
        $inputs['email'] = $me['email'];
        $inputs['password'] = Functions::randomPassword(8);

        $inputs['activated'] = true;

        $inputs['gender'] = (isset($me['gender'])) ? (($me['gender'] == 'male') ? 1 : 2) : null;


        try {

            // register user and add to user group
            $user = User::registerUser($inputs);

            if( ! $user->id) {
                throw new Exception('UserExists');
            }
            else
            {

                UserHelper::addToUserGroup($user);

                UserHelper::addToFbGroup($user);

                UserHelper::generateUserDefaults($user->id);

                UserHelper::checkReferalCode(Session::get('referralCode'), $user->id);

                UserHelper::checkLandingCode(Session::get('ppcCode'), $user->id);

                Session::forget('email');

                $token = Token::where('user_id', $user->id)->first();
                $token->addToken('facebook', Token::makeFacebookToken($getUser));

                User::subscribeMailchimpNewsletter(
                    Config::get('mailchimp')['newsletter'],
                    $user->email,
                    $user->first_name,
                    $user->last_name
                );

                User::sendFacebookWelcomEmail($user, $inputs);

                User::makeUserDir($user);

                User::grabFacebookImage($user, $me);

                Sentry::login($user, false);

                Event::fire('user.registeredFacebook', [$user]);

                $result = self::facebookRedirectHandler($redirect_url, $user, trans('redirect-messages.facebook_signup'));

            }
        } catch (Exception $e) {

            try {
                $user = Sentry::findUserByLogin($me['email']);

                Sentry::login($user, false);

                if (Sentry::check()) {
                    Event::fire('user.loginFacebook', [$user]);
                }

               $result = self::facebookRedirectHandler($redirect_url, $user);


            } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
                Log::error($e);
                $result = $e;
            }
        }

        return $result;


    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

        $this->checkLogin();

        return View::make('users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id, $tab = 0)
    {
        $this->checkLogin();

        return View::make('users.edit')->with('tab', $tab);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $result = User::updateUser($this->user, Input::all());

        if( $result  == 'saved' )
        {
            return Response::json(
                [
                    'callback' => 'gotoUrl',
                    'url'      => Request::root() . '/' . (Trainer::isTrainerLoggedIn(
                        ) ? 'trainers' : 'users') . '/' . $this->user->id . '/edit/profile'
                ]
            );
        }
        else
        {
            return Response::json(
                [
                    'callback' => 'validationFailed',
                    'errors' => $result
                ]
            );
        }
    }


    /**
     * reset password view
     *
     * @param  int $id
     * @return View
     */
    public function getChangePassword()
    {
        return View::make('users.changepassword');
    }

    /**
     * Reset the user's password using the emailed hash
     *
     * @param  int $id
     * @return Response
     */
    public function postChangePassword()
    {
        $user = Sentry::getUser();
        $oldPassword = Input::get('old_password');
        $newPassword = Input::get('password');

        if ($oldPassword == $newPassword && $oldPassword != null) {
            $result = Response::json(
                [
                    'validation_failed' => 1,
                    'errors'            => ['password' => 'your new password matches your old password']
                ]
            );
        }
        elseif($user->checkPassword($oldPassword)){

            $password_validation = User::validUserSignup(Input::all());

            if ($password_validation['validation_failed'] != 0) {
                $result = Response::json(
                    [
                        'callback' => 'validationFailed',
                        'errors' => $password_validation['errors']
                    ]
                );
            }else{
                User::saveNewPassword($newPassword, $user);

                $result = Response::json(
                    [
                        'callback' => 'gotoUrl',
                        'url'      => Request::root() . '/' . (Trainer::isTrainerLoggedIn(
                            ) ? 'trainers' : 'users') . '/' . $user->id . '/edit/password'
                    ]
                );
            }
        }
        else
        {
            $result = Response::json(
                [
                    'validation_failed' => 1,
                    'errors' => ['old_password' => 'Current password incorrect']
                ]
            );
        }

        return $result;
    }

    /**
     * Reset the user's password using the emailed hashed reset code
     *
     * @param  int $id
     * @return View
     */
    public function getResetPassword($display_name, $code)
    {
        try {
            Sentry::findUserByResetPasswordCode($code);
            $result = View::make('users.resetpassword')->with('code', $code);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $result = View::make('users.resetpassword')->with('message', 'Cannot find user');
        }

        return $result;
    }

    /**
     * Reset the user's password using the emailed hash
     *
     * @internal param int $id
     * @return Response
     */
    public function postResetPassword()
    {
        $password_validation = User::validUserSignup(Input::all());

        if ($password_validation['validation_failed'] != 0) {
            $result = Response::json(
                [
                    'callback' => 'validationFailed',
                    'errors' => $password_validation['errors']
                ]
            );
        } else {
            $success = false;
            $email = Input::get('email');
            $password = Input::get('password');
            $code = Input::get('code');
            try {
                $user = Sentry::findUserByLogin($email);

                if ($user->checkResetPasswordCode($code)) {
                    $success = $user->attemptResetPassword($code, $password);
                }
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                Session::flash(
                    'errorNotification',
                    'Sorry we are experiencing technical difficulties, please try again or contact our technical support at support@evercise.com'
                );
                $result = Response::json(
                    [
                        'callback' => 'gotoUrl',
                        'url'      => route('home')
                    ]
                );
                return $result;
            }
            if ($success) {

                UserHelper::changePasswordEvents($user);


                $result = Response::json(
                    [
                        'callback' => 'gotoUrl',
                        'url'      => route('home')
                    ]
                );

            } else {
                $result = Response::json(
                    [
                    'validation_failed' => 1,
                    'errors'            => array('email' => array(0 => 'Wrong email'))
                    ]
                );
            }
        }
        return $result;
    }

    public function getLoginStatus()
    {
        return View::make('users.loginStatus');
    }

    /**
     * Logout Action
     *
     * @return Redirect
     */
    public function logout()
    {
        $user = Sentry::getUser();

        if (!empty($user->id)) {
            Event::fire('user.logout', [$user]);
        }
        Sentry::logout();

        $cookie = Cookie::forget('PHPSESSID');

        return Redirect::route('home')->withCookie($cookie);
    }

    /**
     * @param $redirect
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function facebookRedirectHandler($redirect = null, $user, $message = null)
    {
        if ($redirect != null) {
            if ($redirect == 'trainers.create') // Used when the 'i want to list classes' button is clicked in the register page
            {
                $result = Redirect::route($redirect)->with(
                    'notification', $message
                );

            } else // Used when logging in before hitting the checkout
            {
                $result = Redirect::route($redirect);

            }
        } else {
            $result = Redirect::route((Trainer::isTrainerLoggedIn() ? 'trainers' : 'users') . '.edit.tab', [$user->id, 'evercoins'])
                ->with('notification', $message);

        }

        return $result;
    }


}