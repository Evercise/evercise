<?php

class Evercisegroup extends \Eloquent {

	protected $fillable = array('user_id', 'category_id', 'venue_id', 'name', 'title', 'description', 'image', 'gender', 'capacity', 'default_duration', 'default_price', 'published');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'evercisegroups';

	public function Evercisesession()
    {
        return $this->hasMany('Evercisesession')->orderBy('date_time', 'asc');
    }

    public function futuresessions()
    {
        return $this->hasMany('Evercisesession')->where('date_time', '>=',DB::raw('NOW()'))->orderBy('date_time', 'asc');
        
    }

    public function pastsessions()
    {
        return $this->hasMany('Evercisesession')->where('date_time', '<',DB::raw('NOW()'))->orderBy('date_time', 'asc');
    }

    public function venue()
    {
        return $this->belongsTo('Venue');
    }

    public function Sessionmember()
    {
        return $this->hasManyThrough('Sessionmember', 'Evercisesession');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function confirmed()
     
    {
        //return $this->belongsToMany('Trainer', 'User', 'user_id', 'user_id')->withPivot('id');
        return $this->belongsTo('Trainer', 'user_id', 'user_id')->where('confirmed', 1);
    }

    public function ratings()
    {
        return $this->hasMany('Rating');
    }

     public function category()
    {
        return $this->hasOne('Category', 'id', 'category_id');
    }

     public function tester()
     
    {
        //return $this->belongsToMany('Trainer', 'User', 'user_id', 'user_id')->withPivot('id');
        return $this->belongsTo('Users_groups', 'user_id', 'user_id')->where('group_id', '<>', 5);
    }
}