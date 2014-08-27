<?php

/**
 * Class Evercisesession
 */
class Evercisesession extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array('evercisegroup_id', 'date_time', 'members', 'price', 'duration', 'members_emailed');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evercisesessions';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessionmembers()
    {
        return $this->hasMany('Sessionmember');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evercisegroup()
    {
        return $this->belongsTo('Evercisegroup');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('User', 'sessionmembers', 'evercisesession_id', 'user_id')->withPivot('id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sessionpayment()
    {
        return $this->hasOne('Sessionpayment');
    }


}