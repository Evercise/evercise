<?php namespace ajax;

use User, UserHelper, Session, Input, Config, Sentry, Event, Response, Wallet, Trainer, Request, Redirect, Milestone, Log, Validator;
use View;
use Withdrawalrequest;


class UsersController extends AjaxBaseController
{

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
            $user = User::registerUser(Input::all());

            UserHelper::generateUserDefaults($user->id);

            UserHelper::checkAndUseReferralCode(Session::get('referralCode'), $user->id);
            UserHelper::checkLandingCode(Session::get('ppcCode'), $user->id);

            Session::forget('email');


            if ($user) {

                User::makeUserDir($user);

                User::createImage($user);

                $user->save();

                $this->user = $user;

                // check for newsletter and if so add to mailchimp
                $this->setNewsletter(Input::get('userNewsletter', FALSE));

                Sentry::login($user, TRUE);

                event('user.registered', [$user]);

                if (Input::has('redirect')) {
                    return Response::json(
                        [
                            'callback' => 'gotoUrl',
                            'url'      => route(Input::get('redirect'))
                        ]
                    );
                } else {
                    if (Input::get('trainer', 'no') == 'yes') {
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
            }
        } else {
            return Response::json($valid_user);
        }


    }

    public function storeGuest()
    {
        $inputs = Input::except(['_token']);
        $validator = Validator::make(
            $inputs,
            [
                'first_name' => 'required|max:15|min:2',
                'last_name'  => 'required|max:15|min:2',
                'email'      => 'required|email|unique:users',
                'phone'      => 'numeric',
            ]
        );
        // check user passes validation
        if ($validator->fails()) {
            $valid_user =
                [
                    'callback'          => 'error',
                    'validation_failed' => 1,
                    'errors'            => $validator->errors()->toArray()
                ];
            // log errors
            Log::notice($validator->errors()->toArray());

        } elseif ($inputs['phone'] != '' && $inputs['areacode'] == '') {
            // is user has filled in the area code but no number fail validation
            $valid_user =
                [
                    'callback'          => 'error',
                    'validation_failed' => 1,
                    'errors'            => ['areacode' => 'Please select a country']
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
            $inputs['display_name'] = User::uniqueDisplayName(slugIt($inputs['first_name'] . ' ' . $inputs['last_name']));
            $inputs['activated'] = TRUE;
            $inputs['gender'] = 0;


            // register user and add to user group
            $user = User::registerUser($inputs);

            UserHelper::generateUserDefaults($user->id);

            UserHelper::checkAndUseReferralCode(Session::get('referralCode'), $user->id);
            UserHelper::checkAndUseLandingCode(Session::get('ppcCode'), $user->id);

            Session::forget('email');


            if ($user) {

                User::makeUserDir($user);

                User::createImage($user);

                $user->save();

                $this->user = $user;

                // check for newsletter and if so add to mailchimp
                $this->setNewsletter(Input::get('userNewsletter'));

                Sentry::login($user, TRUE);

                event('user.registered', [$user]);

                if (Input::has('redirect')) {
                    return Response::json(
                        [
                            'callback' => 'gotoUrl',
                            'url'      => route(Input::get('redirect'))
                        ]
                    );
                } else {
                    if (Input::get('trainer', 'no') == 'yes') {
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

        if (!$this->checkLogin()) {
            return Redirect::route('home');
        }

        $valid_user = User::validUserEdit(Input::all());

        if (! $valid_user['validation_failed']) {
            // Actually update the user record
            $params = [
                'first_name'    => Input::get('first_name'),
                'last_name'     => Input::get('last_name'),
                'dob'           => Input::get('dob'),
                'gender'        => (Input::get('gender') == 'male' ? 1 : 2),
                'image'         => Input::get('image'),
                'area_code'     => Input::get('areacode'),
                'phone'         => Input::get('phone'),
                'password'      => Input::get('password'),
                'email'         => Input::get('email'),
            ];

            $this->user->updateUser($params);

            if($this->user->isTrainer()) {
                $this->user->trainer->updateTrainer([
                    'profession' => Input::get('profession', 0),
                    'bio' => Input::get('bio', 0),
                    'website' => Input::get('website', 0),
                ]);
            }

            $this->user->checkProfileMilestones();

            $this->setNewsletter(Input::get('newsletter'));


            event(Trainer::isTrainerLoggedIn() ? 'trainer' : 'user' . '.edit', [$this->user]);

            return Response::json(
                [
                    'callback' => 'gotoUrl',
                    'url'      => route('users.edit', [$this->user->display_name, 'edit'])
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

    function setLocation()
    {

        $lat = Input::get('lat');
        $lon = Input::get('lon');


        Session::put('location', ['lat' => $lat, 'lon' => $lon]);


        $user = Sentry::getUser();

        if (!empty($user->id)) {
            $user->lat = $lat;
            $user->lon = $lon;

            $user->save();
        }

        return Response::json(['stored' => TRUE]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    function getLocation()
    {

        $value = Session::get('location', function () {

            $user = Sentry::getUser();

            return [
                'lat' => ($user->lat == '0.00' ? '' : $user->lat),
                'lon' => ($user->lon == '0.00' ? '' : $user->lon)
            ];
        });

        return Response::json($value);
    }

    private function setNewsletter($newsletter = FALSE)
    {
        if (is_null($this->user->newsletter) || $this->user->newsletter()->count() == 0) {
            $this->user->marketingpreferences()->sync([1]);
        }

        if ($newsletter) {
            $this->user->marketingpreferences()->sync([1]);
            User::subscribeMailchimpNewsletter(Config::get('mailchimp')['newsletter'],
                $this->user->email,
                $this->user->first_name,
                $this->user->last_name
            );
        } else {
            $this->user->marketingpreferences()->sync([2]);
            User::unSubscribeMailchimpNewsletter(Config::get('mailchimp')['newsletter'],
                $this->user->email
            );
        }
    }


    public function requestWithdrawal()
    {
        if(!empty($this->user->id)) {
            $res = [
                'user'         => $this->user,
                'wallet'       => $this->user->getWallet(),
                'payment_date' => Config::get('evercise.payments_to_trainers')
            ];

            $view = View::make('v3.users.withdrawal', $res)->render();

            return Response::json(['view' => $view]);
        } else {
            return Response::json(['error' => 'You need to be logged in to use this feature']);
        }
    }

    public function makeWithdrawal()
    {
        if(!Sentry::check()) {
            return Response::json(['error' => 'You need to be logged in to use this feature']);
        }

        $inputs = Input::all();

        $messages = [
            'min' => 'Minimum amount you can withdraw is £'.Config::get('evercise.minimim_withdraw'),
            'max' => 'Max amount you can withdraw is £'.number_format($this->user->getWallet()->balance)
        ];
        $validations = [
            'paypal' => 'required|email',
            'amount' => 'required|integer|min:'.Config::get('evercise.minimim_withdraw').'|max:'.round($this->user->getWallet()->balance, 0)
        ];
        $validator = Validator::make(
            $inputs,
            $validations,
            $messages
        );

        // if fails add errors to results
        if ($validator->fails()) {
            $result =
                [
                    'callback'          => 'error',
                    'validation_failed' => 1,
                    'errors'            => $validator->errors()->toArray()
                ];

            Log::error($validator->errors()->toArray());

            return Response::json($result);

        }

        $amount = $inputs['amount'];
        $paypal = $inputs['paypal'];

        $wallet = $this->user->getWallet();

        $this->user->paypal_email = $paypal;
        $this->user->save();

        $withdrawal = Withdrawalrequest::create(
            [
                'user_id'            => $this->user->id,
                'transaction_amount' => number_format($amount, 2),
                'account'            => $paypal,
                'acc_type'           => 'paypal',
                'processed'          => 0
            ]
        );

        if ($withdrawal) {

            $wallet->withdraw($amount, 'Withdrawal request', 'withdraw');
            $result =
                [
                    'callback'          => 'success',
                    'validation_failed' => 0,
                    'errors'            => FALSE
                ];

        } else {
            $result =
                [
                    'callback'          => 'error',
                    'validation_failed' => 1,
                    'errors'            => ['We could not process your request. Please try again later']
                ];

            Log::error('Cant process Request ' . $this->user->id . ' amount: ' . $amount);
        }

        return $result;


    }
} 