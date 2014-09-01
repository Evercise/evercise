<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Class User
 */
class User extends Eloquent implements UserInterface, RemindableInterface
{


    /**
     * @var array
     */

    protected $fillable = array(
        'display_name',
        'password',
        'first_name',
        'last_name',
        'email',
        'gender',
        'activation_code',
        'dob',
        'directory',
        'image'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * @param $trainer_id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getUserByTrainerId($trainer_id)
    {
        $user = Static::whereHas('trainer', function ($query) use (&$trainer_id) {
            $query->where('id', $trainer_id);
        })->first();
        return $user;
    }

    /**
     * @return array
     */
    public static function validDatesUserDob()
    {
// dates for validation
        $dt = new DateTime();
        $before = $dt->sub(new DateInterval('P' . Config::get('values')['min_age'] . 'Y'));
        $dateBefore = $before->format('Y-m-d');

        $dt = new DateTime();
        $after = $dt->sub(new DateInterval('P' . Config::get('values')['max_age'] . 'Y'));
        $dateAfter = $after->format('Y-m-d');
        return array($dateBefore, $dateAfter);
    }

    /**
     * @param $inputs
     * @param $dateAfter
     * @param $dateBefore
     * @return \Illuminate\Validation\Validator
     */
    public static function validateUserSignup($inputs, $dateAfter, $dateBefore)
    {
        Validator::extend(
            'has',
            function ($attr, $value, $params) {
                return ValidationHelper::hasRegex($attr, $value, $params);
            }
        );

        // validation rules for input field on register form
        $validator = Validator::make(
            $inputs,
            [
                'display_name' => 'required|max:20|min:5|unique:users',
                'first_name' => 'required|max:15|min:2',
                'last_name' => 'required|max:15|min:2',
                'dob' => 'required|date_format:Y-m-d|after:' . $dateAfter . '|before:' . $dateBefore,
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6|max:32|has:letter,num',
                'phone' => 'numeric',
            ],
            ['password.has' => 'For increased security, please choose a password with a combination of lowercase and numbers',]


        );
        return $validator;
    }

    /**
     * @param $inputs
     * @param $validator
     * @return array
     */
    public static function handleUserValidation($inputs, $validator)
    {
// if fails add errors to results
        if ($validator->fails()) {
            $result =
                [
                    'validation_failed' => 1,
                    'errors' => $validator->errors()->toArray()
                ];
            // log errors
            Log::notice($validator->errors()->toArray());

        } elseif ($inputs['phone'] != '' && $inputs['areacode'] == '') {
            // is user has filled in the area code but no number fail validation
            $result =
                [
                    'validation_failed' => 1,
                    'errors' => ['areacode' => 'Please select a country']
                ];
            Log::notice('Please select a country');
        } else {
            // if validation passes return validation_failed false
            $result = [
                'validation_failed' => 0
            ];
        }
        return $result;
    }

    /**
     * @param $inputs
     * @param $dateAfter
     * @param $dateBefore
     * @return \Illuminate\Validation\Validator
     */
    public static function validateUserEdit($inputs, $dateAfter, $dateBefore)
    {
        $validator = Validator::make(
            $inputs,
            array(
                'first_name' => 'required|max:15|min:2',
                'last_name' => 'required|max:15|min:2',
                'dob' => 'required|date_format:Y-m-d|after:' . $dateAfter . '|before:' . $dateBefore,
                'phone' => 'numeric',
            )
        );
        return $validator;
    }

    /**
     * @param $first_name
     * @param $last_name
     * @param $dob
     * @param $gender
     * @param $image
     * @param $area_code
     * @param $phone
     */
    public static function updateUser($user, $first_name, $last_name, $dob, $gender, $image, $area_code, $phone)
    {
        $user->update(
            array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'dob' => $dob,
                'gender' => $gender,
                'image' => $image,
                'area_code' => $area_code,
                'phone' => $phone,
            )
        );
    }

    public static function checkProfileMilestones($user)
    {
        if (
            $user->gender
            && $user->dob
            && $user->phone
            && $user->image
        ) {
            Event::fire('user.fullProfile', [$user]);
            Milestone::where('user_id', $user->id)->first()->add('profile');
        }
    }

    /**
     * @param $user
     */
    public static function addToUserGroup($user)
    {
        try {
            // find the user group
            $userGroup = Sentry::findGroupById(1);
            // add the user to this group
            $user->addGroup($userGroup);
        } catch (Exception $e) {
            Log::error('cannot add to user group: ' . $e);
        }
    }

    /**
     * @param $user
     */
    public static function addToFbGroup($user)
    {
        try {
            $userGroup = Sentry::findGroupById(2);
            $user->addGroup($userGroup);
        } catch (Exception $e) {
            Log::error('cannot add to facebook group: ' . $e);
        }

    }

    public static function getFacebookUser()
    {
        try {
            // Use a single object of a class throughout the lifetime of an application.
            $application = Config::get('facebook');
            $permissions = 'publish_stream,email,user_birthday,read_stream';
            $url_app = Request::root() . '/login/fb';

            // getInstance
            FacebookConnect::getFacebook($application);
            $getUser = FacebookConnect::getUser($permissions, $url_app); // Return facebook User data

            return $getUser;
        } catch (Exception $e) {
            Log::error('There was an error communicating with Facebook' . $e);
        }

    }

    /**
     * @param $user
     * @param $inputs
     */
    public static function sendFacebookWelcomEmail($user, $inputs)
    {
        Event::fire(
            'user.fb_signup',
            array(
                'email' => $user->email,
                'display_name' => $user->display_name,
                'password' => $inputs['password']
            )
        );
    }

    /**
     * @param $user
     * @param $me
     */
    public static function grabFacebookImage($user, $me)
    {
        $path = public_path() . '/profiles/' . date('Y-m');
        $img_filename = 'facebook-image-' . $user->display_name . '-' . date('d-m') . '.jpg';
        $url = 'http://graph.facebook.com/' . $me['id'] . '/picture?width=200&height=200';

        try {
            $img = file_get_contents($url);
            file_put_contents($path . '/' . $user->id . '_' . $user->display_name . '/' . $img_filename, $img);
        } catch (Exception $e) {
            // This exception will happen from localhost, as pulling the file from facebook will not work
            Log::error('no facebook image :' . $e);
            $img_filename = '';
        }

        $user->image = $img_filename;

        $user->save();
    }

    /**
     * @param $redirect
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function facebookRedirectHandler($redirect, $user , $message = null)
    {
        if (isset($redirect) && $redirect != null) {
            if ($redirect == 'trainer') // Used when the 'i want to list classes' button is clicked in the register page
            {
                $result = Redirect::route('trainers.create')->with(
                    'notification', $message
                );

            } else // Used when logging in before hitting the checkout
            {
                $result = Redirect::route($redirect);
            }
        } else {
            $result = Redirect::route(Trainer::isTrainerLoggedIn() ? 'trainers' : 'users' . '.edit.tab', [$user->id, 'evercoins'])->with(
                'notification',$message
            );
        }

        return $result;
    }


    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }


    /**
     * @return \Illuminate\Validation\Validator
     */
    public static function validUserSignup($inputs)
    {
        list($dateBefore, $dateAfter) = self::validDatesUserDob();

        $validator = self::validateUserSignup($inputs, $dateAfter, $dateBefore);

        return self::handleUserValidation($inputs, $validator);

    }

    /**
     * @return \Illuminate\Validation\Validator
     */
    public static function validUserEdit($inputs)
    {
        list($dateBefore, $dateAfter) = self::validDatesUserDob();

        $validator = self::validateUserEdit($inputs, $dateAfter, $dateBefore);

        return self::handleUserValidation($inputs, $validator);
    }

    /**
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public static function registerUser($inputs)
    {
        $display_name = $inputs['display_name'];
        $first_name = $inputs['first_name'];
        $last_name = $inputs['last_name'];
        $dob = $inputs['dob'];
        $email = $inputs['email'];
        $password = $inputs['password'];
        $area_code = isset($inputs['areacode'])? $inputs['areacode'] : null ;
        $phone = isset($inputs['phone']) ?  $inputs['phone'] : null;
        $gender = isset($inputs['gender']) ?  $inputs['gender'] : null;

        $user = Sentry::register(
            [
                'display_name' => $display_name,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'dob' => $dob,
                'email' => $email,
                'area_code' => $area_code,
                'phone' => $phone,
                'password' => $password,
                'gender' => $gender,
                'activated' => true,
                'directory' => '',
                'image' => '',
                'categories' => ''
            ]
        );
        self::addToUserGroup($user);


        Log::info('new user created called ' . $display_name);

        return $user;
    }

    /**
     * @param $user
     */
    public static function sendWelcomeEmail($user)
    {
        Event::fire(
            'user.signup',
            [
                'email' => $user->email,
                'display_name' => $user->display_name
            ]
        );
    }

    /**
     * @param $newsletter
     * @param $list_id
     * @param $email_address
     */
    public static function subscribeMailchimpNewsletter($list_id, $email_address, $first_name, $last_name)
    {
        try {
            MailchimpWrapper::lists()->subscribe($list_id, ['email' => $email_address], ['FNAME' => $first_name, 'LNAME' => $last_name]);
            Log::info('user added to mailchimp');
        } catch (Mailchimp_Error $e) {
            if ($e->getMessage()) {
                $error = 'Code:' . $e->getCode() . ': ' . $e->getMessage();
                Log::error($error);
            }
        }

    }

    /* foreign keys */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Trainer()
    {
        return $this->hasOne('Trainer');
    }


    /* public function user_has_marketingpreference()
     {
         return $this->hasManyThrough('User_has_marketingpreference', 'Marketingpreference');
     }


     public function Marketingpreferences()
     {
         return $this->belongsToMany('MarketingPreference', 'user_has_marketingpreferences', 'marketingpreferences_id', 'user_id');
     }*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function marketingpreferences()
    {
        return $this->belongsToMany(
            'Marketingpreference',
            'user_marketingpreferences',
            'user_id',
            'marketingpreference_id'
        )->withTimestamps();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sessions()
    {
        return $this->belongsToMany('Evercisesession', 'sessionmembers', 'user_id', 'evercisesession_id')
            ->withPivot('token', 'transaction_id', 'payer_id', 'payment_method')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evercisegroups()
    {
        return $this->hasMany('Evercisegroup');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wallet()
    {
        return $this->hasOne('Wallet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function evercoin()
    {
        return $this->hasOne('Evercoin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function milestone()
    {
        return $this->hasOne('Milestone');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function token()
    {
        return $this->hasOne('Token');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany('Referral');
    }


    /**
     *
     */
    public static function makeUserDir($user)
    {
        $path = public_path() . '/profiles/' . date('Y-m');
        $userFolder = $path . '/' . $user->id . '_' . $user->display_name;
        try {


            if (!file_exists($path)) {
                File::makeDirectory($path);
            }
            if (!file_exists($userFolder)) {
                File::makeDirectory($userFolder);
            }

            $user->directory = date('Y-m') . '/' . $user->id . '_' . $user->display_name;
            $user->save();
        } catch (Exception $e) {
            Log::error('Cannot make user folder : ' . $userFolder . 'error: ' . $e);
        }

        return;
    }

}
