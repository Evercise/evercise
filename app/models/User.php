<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Class User
 */
class User extends Eloquent implements UserInterface, RemindableInterface {


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
        'dob'
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
    public static function validUser($inputs)
    {
        // dates for validation
        $dt = new DateTime();
        $before = $dt->sub(new DateInterval('P' . Config::get('values')['min_age'] . 'Y'));
        $dateBefore = $before->format('Y-m-d');
        $after = $dt->sub(new DateInterval('P' . Config::get('values')['max_age'] . 'Y'));
        $dateAfter = $after->format('Y-m-d');

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
                'first_name' => 'required|max:15|min:3',
                'last_name' => 'required|max:15|min:3',
                'dob' => 'required|date_format:Y-m-d|after:' . $dateAfter . '|before:' . $dateBefore,
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6|max:32|has:letter,num',
                'phone' => 'numeric',
            ],
            ['password.has' => 'For increased security, please choose a password with a combination of lowercase and numbers',]


        );

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
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public static function registerUser($inputs)
    {
        $display_name = str_replace(' ', '_', $inputs['display_name']);
        $first_name = $inputs['first_name'];
        $last_name = $inputs['last_name'];
        $dob = $inputs['dob'];
        $email = $inputs['email'];
        $password = $inputs['password'];
        $area_code = $inputs['areacode'];
        $phone = $inputs['phone'];
        $gender = $inputs['gender'];

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
            ]
        );

        // find the user group
        $userGroup = Sentry::findGroupById(1);
        // add the user to this group
        $user->addGroup($userGroup);

        Log::info('new user created called '. $display_name);

        return $user;
    }

    /**
     * @param $user
     */
    public static function sendWelcomeEmail($user)
    {
        Event::fire(
            'user.signup',
            array(
                'email' => $user->email,
                'display_name' => $user->display_name
            )
        );
    }

    /**
     * @param $newsletter
     * @param $list_id
     * @param $email_address
     */
    public static function subscribeMailchimpNewsletter( $list_id, $email_address,$first_name,$last_name)
    {
        try{
            MailchimpWrapper::lists()->subscribe($list_id, ['email' => $email_address], ['FNAME' => $first_name, 'LNAME' => $last_name]);
            Log::info('user added to mailchimp');
        }catch (Mailchimp_Error $e) {
            if ($e->getMessage()) {
                $error = 'Code:'.$e->getCode().': '.$e->getMessage();
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
    public function makeUserDir()
    {
        $path = public_path() . '/profiles/' . date('Y-m');
        $userFolder = $path . '/' . $this->id . '_' . $this->display_name;
        try {


            if (!file_exists($path)) {
                File::makeDirectory($path);
            }
            if (!file_exists($userFolder)) {
                File::makeDirectory($userFolder);
            }

            $this->directory = date('Y-m') . '/' . $this->id . '_' . $this->display_name;
            $this->save();
        } catch (Exception $e) {
            echo 'Cannot make user folder : ' . $userFolder . '<br>';
            echo 'public_path() : ' . public_path() . '<br>';
            echo $e;
        }

        return;
    }

}
