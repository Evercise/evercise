<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = array('display_name', 'password','first_name', 'last_name', 'email','gender', 'activation_code');

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

	/* forign keys */

	public function Trainer()
    {
        return $this->hasMany('Trainer');
    }


   /* public function user_has_marketingpreference()
    {
        return $this->hasManyThrough('User_has_marketingpreference', 'Marketingpreference');
    }


	public function Marketingpreferences()
    {
        return $this->belongsToMany('MarketingPreference', 'user_has_marketingpreferences', 'marketingpreferences_id', 'user_id');
    }*/

	public function marketingpreferences()
	{
		return $this->belongsToMany('Marketingpreference', 'user_marketingpreferences', 'user_id', 'marketingpreference_id')->withTimestamps();
	}


	public function sessions()
	{
		return $this->belongsToMany('Evercisesession', 'sessionmembers', 'user_id', 'evercisesession_id')->withTimestamps();
	}
	

	public function wallet()
    {
        return $this->hasOne('Wallet');
    }

	public function evercoin()
    {
        return $this->hasOne('Evercoin');
    }


}
