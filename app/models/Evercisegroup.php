<?php

class Evercisegroup extends \Eloquent {

	protected $fillable = array('user_id', 'category_id', 'venue_id', 'name', 'title', 'description', 'image', 'gender', 'capacity', 'default_duration', 'default_price', 'published');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'evercisegroups';

    /**
     * @param $user
     * @return \Illuminate\View\View
     */
    public static function getHub($user)
    {
        $directory = $user->directory;

        $evercisegroups = static::with('evercisesession.sessionmembers')
            ->with('futuresessions.sessionmembers')
            ->with('pastsessions')
            ->with('venue')
            ->where('user_id', $user->id)->get();

        if ($evercisegroups->isEmpty()) {
            return View::make('evercisegroups.first_class');
        } else {
            $sessionDates = array();
            $totalMembers = array();
            $totalCapacity = array();
            $currentDate = new DateTime();

            $evercisegroup_ids = [];
            $stars = [];

            foreach ($evercisegroups as $key => $group) {

                $sessionDates[$key] = Functions::arrayDate($group->EverciseSession->lists('date_time', 'id'));
                //$totalCapacity[] =  $group->capacity * count($group['Evercisesession']);
                $capacity = 0;
                $evercisegroup_ids[] = $group->id;
                foreach ($group['Evercisesession'] as $k => $session) {
                    if (new DateTime($session->date_time) > $currentDate) {
                        $totalMembers[$key][] = count($session->sessionmembers);
                        $capacity += $group->capacity;
                    }
                }
                $totalCapacity[] = $capacity;

            }


            if (!empty($evercisegroup_ids)) {
                $ratings = Rating::whereIn('evercisegroup_id', $evercisegroup_ids)->get();

                foreach ($ratings as $key => $rating) {
                    $stars[$rating->evercisegroup_id][] = $rating->stars;
                }

            }


            $month = date("m");
            $year = date("Y");

            return View::make('evercisegroups.class_hub')
                ->with('evercisegroups', $evercisegroups)
                ->with('sessionDates', $sessionDates)
                ->with('totalMembers', $totalMembers)
                ->with('stars', $stars)
                ->with('totalCapacity', $totalCapacity)
                ->with('year', $year)->with('month', $month)
                ->with('directory', $directory);
        }
    }

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

    public function fakeRatings()
    {
        return $this->hasMany('FakeRating');
    }

    public function stars()
    {
       return $this->hasMany('Rating')->select([ 'evercisegroup_id', 'stars']);
    }

    public function subcategories()
    {
        return $this->belongsToMany('Subcategory', 'evercisegroup_subcategories', 'evercisegroup_id', 'subcategory_id')->withTimestamps();
    }

   public function categories()
    {
        return $this->hasManyThrough('Category', 'Subcategory');
    }

    public function tester()
     
    {
        return $this->belongsTo('Users_groups', 'user_id', 'user_id')->where('group_id', 5);
    }

    public static function concatenateResults($resultsArray)
    {
        $allResults = [];

        foreach ($resultsArray as $results)
        {
            $theseResults = [];

            foreach ($results as $result) {
                //Remove duplicates
                if(! in_array($result, $allResults))
                {
                    $date = $result->futuresessions[0]->date_time;
                    array_push($theseResults, $result);
                }
            }
            usort($theseResults, ['Evercisegroup', "sortFunction"]);
            
            $allResults = array_merge($allResults, $theseResults);
        }

        return $allResults;
    }
    public static function sortFunction( $a, $b ) {
        return strtotime($a->futuresessions[0]->date_time) - strtotime($b->futuresessions[0]->date_time);
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