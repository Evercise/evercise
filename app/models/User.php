<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

/**
 * Class User
 */
class User extends SentryUserModel implements UserInterface, RemindableInterface
{


    /**
     * @var array
     */

    protected $fillable = array(
        'display_name',
        'password',
        'first_name',
        'last_name',
        'activated',
        'reset_password_code',
        'remember_token',
        'persist_code',
        'activated_at',
        'permissions',
        'email',
        'gender',
        'activation_code',
        'dob',
        'area_code',
        'phone',
        'directory',
        'image',
        'custom_commission'
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
    public static function validateUserSignup($inputs/*, $dateAfter, $dateBefore*/)
    {


        // validation rules for input field on register form
        $validator = Validator::make(
            $inputs,
            [
                'display_name' => 'required|max:20|min:5|unique:users',
                'first_name' => 'required|max:15|min:2',
                'last_name' => 'required|max:15|min:2',
                //'dob' => 'required|date_format:Y-m-d|after:' . $dateAfter . '|before:' . $dateBefore,
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|max:32',
                'phone' => 'numeric',
            ]
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
                    'callback' => 'error',
                    'validation_failed' => 1,
                    'errors' => $validator->errors()->toArray()
                ];
            // log errors
            Log::notice($validator->errors()->toArray());

        } elseif ($inputs['phone'] != '' && $inputs['areacode'] == '') {
            // is user has filled in the area code but no number fail validation
            $result =
                [
                    'callback' => 'error',
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

    public static function getFacebookUser($redirect_url)
    {
        try {
            // Use a single object of a class throughout the lifetime of an application.
            $application = Config::get('facebook');
            $permissions = 'publish_stream,email,user_birthday,read_stream';
            if($redirect_url != null)
            {
                $url_app = Request::root() . '/login/fb/'.$redirect_url;
            }
            else
            {
                $url_app = Request::root() . '/login/fb';
            }


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
    public static function facebookRedirectHandler($redirect = null, $user ,$message = null)
    {
        if ($redirect != null) {
            if ($redirect == 'trainers.create') // Used when the 'i want to list classes' button is clicked in the register page
            {
                $result = Redirect::route($redirect)->with(
                    'notification', $message
                );

            }
            else // Used when logging in before hitting the checkout
            {
                $result = Redirect::route($redirect);

            }
        } else {
            $result = Redirect::route('finished.user.registration');

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
       /* date of birth not been used in v3
       * list($dateBefore, $dateAfter) = self::validDatesUserDob();
       */


       $validator = self::validateUserSignup($inputs/*, $dateAfter, $dateBefore*/);

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
        $email = $inputs['email'];
        $password = $inputs['password'];
        $area_code = isset($inputs['areacode'])? $inputs['areacode'] : '+44' ;
        $phone = isset($inputs['phone']) ?  $inputs['phone'] : '';
        $gender = isset($inputs['gender']) ?  $inputs['gender'] : null;

        $user = Sentry::register(
            [
                'display_name' => $display_name,
                'first_name' => $first_name,
                'last_name' => $last_name,
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

    public function sendForgotPasswordEmail($reset_code)
    {

        \Event::fire('user.forgot', array(
            'email' => $this->email,
            'displayName' => $this->display_name,
            'resetCode' => $reset_code
        ));
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

    /**
     * Get full name from either User object or a user id
     *
     * @param $id
     * @return string
     */
    public static function getName($userOrId)
    {
        if (! is_a($userOrId, 'Eloquent') ) // parameter passed in is id
            $user = static::select('first_name', 'last_name')->where('id', $userOrId)->firstOrFail();
        else                                // parameter passed in is User
            $user = $userOrId;

        return static::getFullName($user);
    }

    /**
     * Get full name and email from either User object or a user id
     *
     * @param $id
     * @return string
     */
    public static function getNameAndEmail($userOrId)
    {
        if (! is_a($userOrId, 'Eloquent') )
            $user = User::select('first_name', 'last_name', 'email')->where('id', $userOrId)->firstOrFail();
        else
            $user = $userOrId;

        return ['name' => static::getFullName($user), 'email' => $user->email];
    }

    /**
     * Concatenate first and last names from User object
     *
     * @param $user
     * @return string
     */
    public static function getFullName($user)
    {
        return $user->first_name . ' ' . $user->last_name;
    }

    /* foreign keys */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function trainer()
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pastsessions()
    {
        return $this->belongsToMany('Evercisesession', 'sessionmembers', 'user_id', 'evercisesession_id')
            ->withPivot('token', 'transaction_id', 'payer_id', 'payment_method')
            ->where('date_time', '<', DB::raw('NOW()'))
            ->orderBy('date_time', 'asc')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function futuresessions()
    {
        return $this->belongsToMany('Evercisesession', 'sessionmembers', 'user_id', 'evercisesession_id')
            ->withPivot('token', 'transaction_id', 'payer_id', 'payment_method')
            ->where('date_time', '>=', DB::raw('NOW()'))
            ->orderBy('date_time', 'asc')
            ->withTimestamps();
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
    public function wallethistory()
    {
        return $this->hasMany('Wallethistory');
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
        $dir = hashDir($user->id, 'u');
        $user->directory = $dir;
        $user->save();

        return;
    }
    public function resetPassword()
    {
        $newPassword = Functions::randomPassword(7);
        $resetPasswordCode = $this->getResetPasswordCode();
        $this->attemptResetPassword($resetPasswordCode, $newPassword);

        return $newPassword;
    }

}
