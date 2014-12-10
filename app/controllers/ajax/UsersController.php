<?php namespace ajax;

use User, UserHelper, Session, Input, Config, Sentry, Event, Response, Wallet, Trainer, Request, Redirect, Milestone, Log, Validator;


class UsersController extends AjaxBaseController{

    public function __construct()
    {
        parent::__construct();
        $this->user = Sentry::getUser();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // check user passes validation
        $valid_user = User::validUserSignup(Input::all());

        if ($valid_user['validation_failed'] == 0) {

            // register user and add to user group
            $user = User::registerUser( Input::all() );

            UserHelper::generateUserDefaults($user->id);

            UserHelper::checkAndUseReferralCode(Session::get('referralCode'), $user->id);
            UserHelper::checkLandingCode(Session::get('ppcCode'), $user->id);

            Session::forget('email');


            if ($user) {

                User::makeUserDir($user);

                User::createImage($user);

                $user->save();

                // check for newsletter and if so add to mailchimp

                $newsletter = Input::get('userNewsletter');
                $email_address = Input::get('email');
                $first_name = Input::get('first_name');
                $last_name = Input::get('last_name');
                if (!empty($newsletter)) {
                    User::subscribeMailchimpNewsletter(Config::get('mailchimp')['newsletter'],
                        $email_address,
                        $first_name,
                        $last_name
                    );
                }


                Sentry::login($user, true);

                event('user.registered', [$user]);

                if (Input::has('redirect')) {
                    return Response::json(
                        [
                            'callback' => 'gotoUrl',
                            'url'      => route(Input::get('redirect'))
                        ]
                    );
                }
                else if (Input::get('trainer', 'no') == 'yes' ) {
                    return Response::json(
                        [
                            'callback' => 'gotoUrl',
                            'url'      => route('trainers.create')
                        ]
                    );
                } else {

                    User::sendWelcomeEmail($user);


                    return Response::json(
                        [
                            'callback' => 'gotoUrl',
                            'url'      => route('finished.user.registration')
                        ]
                    );

                }
            }
        } else {
            return Response::json($valid_user);
        }


    }

    public function storeGuest()
    {
        $inputs =  Input::except(['_token']);
        $validator = Validator::make(
            $inputs,
            [
                'first_name' => 'required|max:15|min:2',
                'last_name' => 'required|max:15|min:2',
                'email' => 'required|email|unique:users',
                'phone' => 'numeric',
            ]
        );
        // check user passes validation
        if ($validator->fails()) {
            $valid_user =
                [
                    'callback' => 'error',
                    'validation_failed' => 1,
                    'errors' => $validator->errors()->toArray()
                ];
            // log errors
            Log::notice($validator->errors()->toArray());

        } elseif ($inputs['phone'] != '' && $inputs['areacode'] == '') {
            // is user has filled in the area code but no number fail validation
            $valid_user =
                [
                    'callback' => 'error',
                    'validation_failed' => 1,
                    'errors' => ['areacode' => 'Please select a country']
                ];
            Log::notice('Please select a country');
        } else {
            // if validation passes return validation_failed false
            $valid_user = [
                'validation_failed' => 0
            ];
        }

        if ($valid_user['validation_failed'] == 0) {

            $inputs['password'] = str_random(12);
            $inputs['display_name'] = User::uniqueDisplayName(slugIt($inputs['first_name'].' '.$inputs['last_name']));
            $inputs['activated'] = true;
            $inputs['gender'] = 0;


            // register user and add to user group
            $user = User::registerUser($inputs);

            UserHelper::generateUserDefaults($user->id);

            UserHelper::checkAndUseReferralCode(Session::get('referralCode'), $user->id);
            UserHelper::checkLandingCode(Session::get('ppcCode'), $user->id);

            Session::forget('email');


            if ($user) {

                User::makeUserDir($user);

                User::createImage($user);

                $user->save();

                // check for newsletter and if so add to mailchimp

                $newsletter = Input::get('userNewsletter');
                $email_address = Input::get('email');
                $first_name = Input::get('first_name');
                $last_name = Input::get('last_name');
                if (!empty($newsletter)) {
                    User::subscribeMailchimpNewsletter(Config::get('mailchimp')['newsletter'],
                        $email_address,
                        $first_name,
                        $last_name
                    );
                }

                Sentry::login($user, true);

                event('user.registered', [$user]);

                if (Input::has('redirect')) {
                    return Response::json(
                        [
                            'callback' => 'gotoUrl',
                            'url'      => route(Input::get('redirect'))
                        ]
                    );
                }
                else if (Input::get('trainer', 'no') == 'yes' ) {
                    return Response::json(
                        [
                            'callback' => 'gotoUrl',
                            'url'      => route('trainer')
                        ]
                    );
                } else {

                    User::sendGuestWelcomeEmail($user);


                    return Response::json(
                        [
                            'callback' => 'gotoUrl',
                            'url'      => route('cart.checkout')
                        ]
                    );

                }
            }
        } else {
            return Response::json($valid_user);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update()
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
            $image = Input::get('image');
            $area_code = Input::get('areacode');
            $phone = Input::get('phone');
            $password = Input::get('password');
            $newsletter = Input::get('newsletter');

            $this->user->updateUser($first_name, $last_name, $dob, $gender, $image, $area_code, $phone, $password);

            $this->user->checkProfileMilestones();

            if(!empty($newsletter)) {
                if ($this->user->newsletter[0]->option != 'yes') {
                    $this->user->marketingpreferences()->sync([1]);
                    User::subscribeMailchimpNewsletter(Config::get('mailchimp')['newsletter'],
                        $this->user->email,
                        $first_name,
                        $last_name
                    );
                }
            }else{
                if ($this->user->newsletter[0]->option == 'yes') {
                    $this->user->marketingpreferences()->sync([2]);
                    User::unSubscribeMailchimpNewsletter(Config::get('mailchimp')['newsletter'],
                        $this->user->email
                    );
                }
            }



            event(Trainer::isTrainerLoggedIn() ? 'trainer' : 'user' . '.edit', [$this->user]);

            return Response::json(
                [
                    'callback' => 'gotoUrl',
                    'url' => route('users.edit', [ $this->user->display_name, 'edit'])
                ]
            );
        } else {
            return Response::json($valid_user);
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

    function setLocation() {

        $lat = Input::get('lat');
        $lon = Input::get('lon');


        Session::put('location', ['lat' => $lat, 'lon' => $lon]);


        $user = Sentry::getUser();

        if(!empty($user->id)) {
            $user->lat = $lat;
            $user->lon = $lon;

            $user->save();
        }

        return Response::json(['stored' => true]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    function getLocation() {

        $value = Session::get('location', function() {

            $user = Sentry::getUser();
            return [
                'lat' => ($user->lat == '0.00' ? '': $user->lat),
                'lon' => ($user->lon == '0.00' ? '': $user->lon)
            ];
        });

        return Response::json($value);
    }
} 