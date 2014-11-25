<?php namespace ajax;

use User, UserHelper, Session, Input, Config, Sentry, Event, Response, Wallet;

class UsersController extends AjaxBaseController{

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

            UserHelper::checkReferalCode(Session::get('referralCode'), $user->id);

            UserHelper::checkLandingCode(Session::get('ppcCode'), $user->id);

            Session::forget('email');


            if ($user) {

                User::makeUserDir($user);

                $user->save();

                // check for newsletter and if so add to mailchimp

                $newsletter = Input::get('userNewsletter');
                $email_address = Input::get('email');
                $first_name = Input::get('first_name');
                $last_name = Input::get('last_name');
                if (!empty($newsletter)) {
                    User::subscribeMailchimpNewsletter(                        Config::get('mailchimp')['newsletter'],
                        $email_address,
                        $first_name,
                        $last_name
                    );
                }

                Wallet::createIfDoesntExist($user->id);

                Sentry::login($user, true);

                Event::fire('user.registered', [$user]);



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

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
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
            $image = Input::get('thumbFilename');
            $area_code = Input::get('areacode');
            $phone = Input::get('phone');


            $this->user->updateUser($first_name, $last_name, $dob, $gender, $image, $area_code, $phone);

            $this->user->checkProfileMilestones();

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