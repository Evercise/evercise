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
        // If a user is already logged in, kick em out so a new account can be created.
        Sentry::logout();

        $referral = Referral::checkReferralCode(Session::get('referralCode'));
        $ppcCode = Landing::checkLandingCode(Session::get('ppcCode'));
        if(!$ppcCode)
            $ppcCode = StaticLanding::checkLandingCode(Session::get('ppcCode'));

        $ppcDb = Landing::where('code', Session::get('ppcCode'))->first();

        $email = '';

        if(!empty($ppcDb->email)) {
            $email = $ppcDb->email;
        }
        if(!empty($referral->email)) {
            $email = $referral->email;
        }

        return View::make('v3.users.create')
            ->with('referralCode', $referral ? $referral->code : null)
            ->with('redirect', $redirect)
            ->with('ppcCode', $ppcCode)
            ->with('email', $email);

    }




    public function guestCheckout() {



        $referral = Referral::checkReferralCode(Session::get('referralCode'));
        $ppcCode = Landing::checkLandingCode(Session::get('ppcCode'));


        return View::make('v3.users.guest')
            ->with('referralCode', $referral ? $referral->code : null)
            ->with('redirect', 'cart/checkout')
            ->with('ppcCode', $ppcCode)
            ->with('email', $referral ? $referral->email : '');


    }


    public function fb_login($redirect_url = null, $params = '')
    {

        $getUser = User::getFacebookUser($redirect_url);

        $me = $getUser['user_profile'];


        if(!empty($params)) {
            Session::put('FB_REDIRECT_PARAMS', $params);
        }


        if(!empty($params)) {

        }


        if (empty($me)) {
            return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
        }


        $inputs = [];
        $inputs['display_name'] = slugIt($me['name']);
        $inputs['first_name'] = $me['first_name'];
        $inputs['last_name'] = $me['last_name'];
        $inputs['dob'] = isset($me['birthday']) ? new DateTime($me['birthday']) : null;
        $inputs['email'] = $me['email'];
        $inputs['password'] = Functions::randomPassword(8);

        $inputs['activated'] = true;

        $inputs['gender'] = (isset($me['gender'])) ? (($me['gender'] == 'male') ? 1 : 2) : null;


        try {

            // register user and add to user group
            $user = User::registerUser($inputs);


            if ($user) {

                User::addToUserGroup($user);

                User::addToFbGroup($user);

                UserHelper::generateUserDefaults($user->id);

                UserHelper::checkAndUseReferralCode(Session::get('referralCode'), $user->id);

                UserHelper::checkAndUseLandingCode(Session::get('ppcCode'), $user->id);

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

                $result = User::facebookRedirectHandler($redirect_url, $user, trans('redirect-messages.facebook_signup'));

                event('user.registeredFacebook', [$user]);

            }
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {

            try {
                $user = Sentry::findUserByLogin($me['email']);

                Sentry::login($user, false);



                if (Sentry::check()) {
                    event('user.loginFacebook', [$user]);
                }

                //$result = User::facebookRedirectHandler($redirect_url, $user);

                $result = Redirect::route('users.edit', ['id'=>$user->display_name]);

                $params = [];
                if (Session::has('FB_REDIRECT_PARAMS')) {
                    $data = explode(':', Session::get('FB_REDIRECT_PARAMS'));

                    if (!empty($data[1])) {
                        $params[$data[0]] = $data[1];
                    }
                    Session::forget('FB_REDIRECT_PARAMS');
                }



                if(!is_null($redirect_url)) {
                    $result = Redirect::route($redirect_url, $params);
                }

            } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
                Log::error($e->getMessage());
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


        if(!$this->checkLogin()) {
            return Redirect::route('home');
        }

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
        $activity = Activities::getAll($this->user->id, Config::get('evercise.user.activities', 100));

        $activity_group = [];

        foreach($activity as $a) {
            $activity_group[$a->format_date][] = $a;
        }

        $user = $this->user;
        $data = [
            'user' => $user,
            'activity' => $activity_group
        ];

        if(Trainer::isTrainerLoggedIn())
        {
            $hub = Evercisegroup::getTrainerHub($user);
            $data = array_merge($hub, $data);

            $view = 'v3.users.profile.master_trainer';
        }
        else
        {
            $hub = Evercisegroup::getUserHub($user);
            $data = array_merge($hub, $data);

            $view = 'v3.users.profile.master_user';
        }




        return View::make( $view )
            ->with('data', $data)
            ->with('tab', $tab);
    }


    /**
     * Activate the user using the emailed hash
     *
     * @param  int $id
     * @return Response
     */
    public function pleaseActivate($display_name)
    {
        return View::make('users.activate')->with('display_name', $display_name);

    }

    /**
     * Reset the user's password using the emailed hash
     *
     * @param  int $id
     * @return Response
     */
    public function postChangePassword()
    {

        Validator::extend(
            'has',
            function ($attr, $value, $params) {
                return ValidationHelper::hasRegex($attr, $value, $params);
            }
        );

        $validator = Validator::make(
            Input::all(),
            [
                'old_password' => 'required',
                'new_password' => 'required|confirmed|min:6|max:32',
            ]
        );

        $oldPassword = Input::get('old_password');
        $newPassword = Input::get('new_password');

        if ($validator->fails()) {

            return Response::json(['validation_failed' => 1, 'errors' => $validator->errors()->toArray()]);
        } else {
            if ($oldPassword == $newPassword) {
                return Response::json(
                    [
                        'validation_failed' => 1,
                        'errors'            => ['new_password' => 'your new password matches your old password']
                    ]
                );
            }
            if ($this->user->checkPassword($oldPassword)) {
                $this->user->password = $newPassword;
                $this->user->save();

                event('user.changedPassword', [ $this->user ]);

                return Response::json(['result' => 'changed', 'callback' => 'successAndRefresh']);
            }
            return Response::json(
                ['validation_failed' => 1, 'errors' => ['old_password' => 'Current password incorrect']]
            );
        }
    }

    /**
     * Reset the user's password using the emailed hash
     *
     * @param  int $id
     * @return View
     */
    public function getResetPassword($display_name, $code)
    {
        try {
            $user = Sentry::findUserByResetPasswordCode($code);
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return View::make('v3.auth.resetpassword')->with('message', 'Cannot find user');
        }

        return View::make('v3.auth.resetpassword')->with('code', $code);
    }

    /**
     * Reset the user's password using the emailed hash
     *
     * @internal param int $id
     * @return Response
     */
    public function postResetPassword()
    {
        Validator::extend(
            'has',
            function ($attr, $value, $params) {
                return ValidationHelper::hasRegex($attr, $value, $params);
            }
        );

        $validator = Validator::make(
            Input::all(),
            array(
                'email' => 'required|email',
                'password' => 'required|confirmed|min:6|max:32',
            ),
            ['password.has' => 'The password must contain at least one number and can be a combination of lowercase letters and uppercase letters.',]
        );

        $email = Input::get('email');
        $password = Input::get('password');
        $code = Input::get('code');

        if ($validator->fails()) {
            return Response::json([
                'validation_failed' => 1,
                'errors'            => $validator->errors()->toArray()
            ]);
        } else {
            $success = false;
            try {
                $user = Sentry::findUserByLogin($email);

                if ($user->checkResetPasswordCode($code)) {
                    $success = $user->attemptResetPassword($code, $password);

                }
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                //return View::make('v3.auth.resetpassword')->with('message', 'Could not find user. Please check your email address');
                Session::flash(
                    'errorNotification',
                    'Sorry we are experiencing technical difficulties, please try again or contact our technical support at support@evercise.com'
                );
                return Response::json(route('home'));
            }
            if ($success) {
                event('user.changedPassword', [$user]);

                Session::flash('notification', 'Password reset successful');
                return Response::json(
                    [
                        'callback' => 'gotoUrl',
                        'url'      => route('home')
                    ]
                );

            } else {
                $result = array(
                    'validation_failed' => 1,
                    'errors'            => array('email' => array(0 => 'Wrong email'))
                );

                return Response::json($result);
            }

        }

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

        if(!$this->checkLogin()) {
            return Redirect::route('home');
        }


        $user = Sentry::getUser();

        if (!empty($user->id)) {
            event('user.logout', [$user]);
        }
        Sentry::logout();

        $cookie = Cookie::forget('PHPSESSID');

        return Redirect::route('home')->withCookie($cookie);
    }

    public function replyToMessage($user_slug)
    {

    }
    public function fuck()
    {
        return 'COCK';
    }


}