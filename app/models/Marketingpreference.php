<?php

/**
 * Class Marketingpreference
 */
class Marketingpreference extends \Eloquent
{

    /**
     * @var array
     */
    protected $guarded = array('id', 'name', 'option');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marketingpreferences';

    /*
     public function User_marketingpreferences()
        {
        return $this->belongsToMany('User', 'user_marketingpreferences', 'user_id', 'marketingpreferences_id');
        }
    */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('User');
    }
}