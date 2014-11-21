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

} 