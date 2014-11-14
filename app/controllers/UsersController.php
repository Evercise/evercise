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

        return View::make('v3.users.create')
            ->with('referralCode', $referralCode)
            ->with('redirect', $redirect)
            ->with('ppcCode', $ppcCode)
            ->with('email', $email);

    }



    public function fb_login($redirect_url = null)
    {

        $getUser = User::getFacebookUser($redirect_url);

        $me = $getUser['user_profile'];


        if (empty($me)) {
            return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
        }


        $inputs = [];
        $inputs['display_name'] = str_replace(' ', '_', $me['name']);
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

                $result = User::facebookRedirectHandler($redirect_url, $user, trans('redirect-messages.facebook_signup'));

                Event::fire('user.registeredFacebook', [$user]);

            }
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {

            try {
                $user = Sentry::findUserByLogin($me['email']);

                Sentry::login($user, false);



                if (Sentry::check()) {
                    Event::fire('user.loginFacebook', [$user]);
                }


               $result = User::facebookRedirectHandler($redirect_url, $user);


            } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
                Log::error($e);
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

        if(!$this->checkLogin()) {
            return Redirect::route('home');
        }

        $user = $this->user;
        $data = [
            'user' => $user,
        ];

        // if user is trainer lob hub into data


        if(Trainer::isTrainerLoggedIn())
        {
            $hub = Evercisegroup::getHub($user);
            $data = array_merge($hub, $data);

            $view = 'v3.users.profile.master_trainer';
        }
        else
        {
            $view = 'v3.users.profile.master_user';
        }

        return View::make( $view )
            ->with('data', $data)
            ->with('tab', $tab);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        if(!$this->checkLogin()) {
            return Redirect::route('home');
        }

        $valid_user = User::validUserEdit(Input::all());

        if ($valid_user['validation_failed'] == 0) {
            // Actually update the user record
            $first_name = Input::get('first_name');
            $last_name = Input::get('last_name');
            $dob = Input::get('dob');
            $gender = Input::get('gender');
            $image = Input::get('thumbFilename');
            $area_code = Input::get('areacode');
            $phone = Input::get('phone');


            User::updateUser($this->user, $first_name, $last_name, $dob, $gender, $image, $area_code, $phone);

            User::checkProfileMilestones($this->user);

            Event::fire(Trainer::isTrainerLoggedIn() ? 'trainer' : 'user' . '.edit', [$this->user]);

            return Response::json(
                [
                    'callback' => 'gotoUrl',
                    'url'      => Request::root() . '/' . (Trainer::isTrainerLoggedIn(
                        ) ? 'trainers' : 'users') . '/' . $this->user->id . '/edit/profile'
                ]
            );
        } else {
            return Response::json($valid_user);
        }


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
     * @return View
     */
    public function getChangePassword($display_name)
    {
        // Init JS from composer as used for trainers as well as users
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
                'new_password' => 'required|confirmed|min:6|max:32|has:letter,num',
            ],
            ['new_password.has' => 'For increased security, please choose a password with a combination of lowercase and numbers',]
        );

        $oldPassword = Input::get('old_password');
        $newPassword = Input::get('new_password');

        if ($validator->fails()) {

            if (Request::ajax()) {
                return Response::json(['validation_failed' => 1, 'errors' => $validator->errors()->toArray()]);
            } else {
                return Redirect::route('users.resetpassword')
                    ->withErrors($validator)
                    ->withInput();
            }
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

                Event::fire('user.changedPassword', [ $this->user ]);

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
            return View::make('users.resetpassword')->with('message', 'Cannot find user');
        }

        return View::make('users.resetpassword')->with('code', $code);
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
                'password' => 'required|confirmed|min:6|max:32|has:letter,num',
            ),
            ['password.has' => 'The password must contain at least one number and can be a combination of lowercase letters and uppercase letters.',]
        );

        $email = Input::get('email');
        $password = Input::get('password');
        $code = Input::get('code');

        if ($validator->fails()) {

            if (Request::ajax()) {
                $result = array(
                    'validation_failed' => 1,
                    'errors'            => $validator->errors()->toArray()
                );

                return Response::json($result);
            } else {
                return Redirect::route('users.resetpassword')
                    ->withErrors($validator)
                    ->withInput();
            }
        } else {
            $success = false;
            try {
                $user = Sentry::findUserByLogin($email);

                if ($user->checkResetPasswordCode($code)) {
                    $success = $user->attemptResetPassword($code, $password);

                }
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                //return View::make('users.resetpassword')->with('message', 'Could not find user. Please check your email address');
                Session::flash(
                    'errorNotification',
                    'Sorry we are experiencing technical difficulties, please try again or contact our technical support at support@evercise.com'
                );
                return Response::json(route('home'));
            }
            if ($success) {
                Event::fire(
                    'user.newpassword',
                    [
                        'email' => $email
                    ]
                );
                Event::fire('user.changedPassword', [$user]);

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
            Event::fire('user.logout', [$user]);
        }
        Sentry::logout();

        $cookie = Cookie::forget('PHPSESSID');

        return Redirect::route('home')->withCookie($cookie);
    }


}