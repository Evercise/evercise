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

    public function stars()
    {
       return $this->hasMany('Rating')->select([ 'evercisegroup_id', 'stars']);
    }

    public function subcategories()
    {
        return $this->belongsToMany('Subcategory', 'evercisegroup_subcategories', 'evercisegroup_id', 'subcategory_id')->withTimestamps();
    }

  /*  public function categories()
    {
        return $this->hasManyThrough('categories', 'subcategories_categories');
    }*/

    public function tester()
     
    {
        return $this->belongsTo('Users_groups', 'user_id', 'user_id')->where('group_id', 5);
    }

    public static function concatenateResults($resultsArray)
    {
        $allResults = [];

        foreach ($resultsArray as $results)
        {
            foreach ($results as $result) {
                if(! in_array($result, $allResults))
                {
                    array_push($allResults, $result);
                }
            }
        }

        return $allResults;
    }

    public function getStars()
    {
        $stars = 0;
        foreach ($this->ratings as $key => $rating) {
            $stars += $rating->stars;
        }
        $stars = count($this->ratings) ? $stars / count($this->ratings) : 0;
        

        return $stars;
    }

}