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

    /**
     * @return mixed
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * @param string $value
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /* forign keys */

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
