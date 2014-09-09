<?php

/**
 * Class Evercisegroup
 */
class Evercisegroup extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array(
        'user_id',
        'category_id',
        'venue_id',
        'name',
        'title',
        'description',
        'image',
        'gender',
        'capacity',
        'default_duration',
        'default_price',
        'published'
    );
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evercisegroups';

    /**
     * @return \Illuminate\View\View
     */
    public static function getHub()
    {
        $evercisegroups = static::with('evercisesession.sessionmembers')
            ->with('futuresessions.sessionmembers')
            ->with('pastsessions')
            ->with('venue')
            ->where('user_id', Sentry::getUser()->id)->get();

        if ($evercisegroups->isEmpty())
        {
            return 0;
        }
        else
        {
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

            return [
                'evercisegroups' => $evercisegroups,
                'sessionDates' => $sessionDates,
                'totalMembers' => $totalMembers,
                'stars' => $stars,
                'totalCapacity' => $totalCapacity
            ];
        }
    }

    /**
     * @param $location
     * @param $category
     * @param $radius
     * @param $page
     * @return \Illuminate\View\View
     */
    public static function doSearch($location, $category, $radius, $page)
    {
        //return $location['address'];
        if (isset($location['lat']) && isset($location['lng'])) {
            $latitude = $location['lat'];
            $longitude = $location['lng'];
        } else {
            $latlng = Geo::getLatLng($location['address']);
            $latitude = $latlng['lat'];
            $longitude = $latlng['lng'];
        }



        $testers = Sentry::findGroupById(5);
        $testerLoggedIn = Sentry::getUser() ? Sentry::getUser()->inGroup($testers) : false;

        $haversine = '(3959 * acos(cos(radians(' . $latitude . ')) * cos(radians(lat)) * cos(radians(lng) - radians(' . $longitude . ')) + sin(radians(' . $latitude . ')) * sin(radians(lat))))';

        /* set the number of arrays needed per level */
        $results = [[], [], [], [], []];

        // SEARCH LEVEL 1
        $results[0] = Evercisegroup::has('futuresessions')
            ->has('confirmed')
            ->has('tester', '<', $testerLoggedIn ? 5 : 1)// testing to make sure class does not belong to the tester
            ->whereHas('venue', function ($query) use (&$haversine, &$radius) {
                    $query->select(array(DB::raw($haversine . ' as distance')))
                        ->having('distance', '<', $radius);
                })
            ->whereHas('subcategories', function ($query) use ($category) {
                $query->where('name', 'LIKE', '%' . $category . '%');
            })
            ->with('venue')
            ->with('user')
            ->with('ratings')
            ->with('futuresessions')
            ->get();


        // SEARCH LEVEL 2 ( if level 1 returns less than 9 results)
        if (count($results[0]) < 9) {
            $results[1] = Evercisegroup::has('futuresessions')
                ->has('confirmed')
                ->has('tester', '<', $testerLoggedIn ? 5 : 1)// testing to make sure class does not belong to the tester
                ->whereHas('venue', function ($query) use (&$haversine, &$radius) {
                        $query->select(array(DB::raw($haversine . ' as distance')))
                            ->having('distance', '<', $radius);
                    })
                ->whereHas('subcategories', function ($query) use ($category) {

                    $query->whereHas('categories', function ($subquery) use ($category) {
                        $subquery->where('name', 'LIKE', '%' . $category . '%');
                    });
                })
                //->with('categories')
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        // SEARCH LEVEL 3 ( if level 1 and level 2 return less than 9 results)
        if (count($results[0]) + count($results[1]) < 9) {
            $results[2] = Evercisegroup::has('futuresessions')
                ->has('confirmed')
                ->has('tester', '<', $testerLoggedIn ? 5 : 1)// testing to make sure class does not belong to the tester
                ->whereHas('venue', function ($query) use (&$haversine, &$radius) {
                        $query->select(array(DB::raw($haversine . ' as distance')))
                            ->having('distance', '<', $radius);
                    })
                ->where('name', 'LIKE', '%' . $category . '%')
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        // SEARCH LEVEL 4 ( if level 1, 2 and 3 return less than 9 results)
        if (count($results[0]) + count($results[1]) + count($results[2]) < 9) {
            $results[3] = Evercisegroup::has('futuresessions')
                ->has('confirmed')
                ->has('tester', '<', $testerLoggedIn ? 5 : 1)// testing to make sure class does not belong to the tester
                ->whereHas('venue', function ($query) use (&$haversine, &$radius) {
                        $query->select(array(DB::raw($haversine . ' as distance')))
                            ->having('distance', '<', $radius);
                    })
                ->where('description', 'LIKE', '%' . $category . '%')
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        // SEARCH LEVEL 5
        if (count($results[0]) + count($results[1]) + count($results[2]) + count($results[3]) < 9) {
            $results[4] = Evercisegroup::has('futuresessions')
                ->has('confirmed')
                ->has('tester', '<', $testerLoggedIn ? 5 : 1)// testing to make sure class does not belong to the tester
                ->whereHas('venue', function ($query) use (&$haversine, &$radius) {
                        $query->select(array(DB::raw($haversine . ' as distance')))
                            ->having('distance', '<', $radius);
                    })
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        // SEARCH LEVEL 6
        if (count($results[0]) + count($results[1]) + count($results[2]) + count($results[3]) + count($results[4]) < 9)
        {
            $results[5] = Evercisegroup::has('futuresessions')
                ->has('confirmed')
                ->has('tester', '<', $testerLoggedIn ? 5 : 1) // testing to make sure class does not belong to the tester
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        $allResults = Evercisegroup::concatenateResults($results);

        $perPage = 12;


        if ($page > count($allResults) or $page < 1) { $page = 1; }
        $offset = ($page * $perPage) - $perPage;
        $articles = array_slice($allResults,$offset,$perPage);
        $paginatedResults = Paginator::make($articles, count($allResults), $perPage);
        $mapResult = [];

        foreach($allResults as $result){
            unset($result['description']);
            unset($result['default_duration']);
            unset($result['published']);
            unset($result['created_at']);
            unset($result['updated_at']);
            unset($result['user']);
            unset($result['venue_id']);
            unset($result['title']);
            unset($result['gender']);
            $mapResult[] = $result->toJson();
        }

        //return json_encode($mapResult);


        return [
            '$mapResult' => $mapResult,
            '$paginatedResults', $paginatedResults
        ];
    }

    /**
     * @param $categories
     * @param $evercisegroup
     */
    public static function adminAddSubcategories($categories, $evercisegroup)
    {
        foreach ($categories as $key => $category) {
            $categories[$key] = Subcategory::where('name', $category)->pluck('id');
        }
        $evercisegroup->subcategories()->detach();
        if (!empty($categories)) $evercisegroup->subcategories()->attach($categories);
    }

    /**
     * @param $id
     * @param $is_featured
     */
    public static function adminMakeClassFeatured($id, $is_featured)
    {
        if ($is_featured) {
            $featured = FeaturedClasses::firstOrCreate(['evercisegroup_id' => $id]);

            $featured->evercisegroup_id = $id;

            $featured->save();

        } else {
            FeaturedClasses::where('evercisegroup_id', $id)->delete();
        }
    }

    /**
     * @return mixed
     */
    public function Evercisesession()
    {
        return $this->hasMany('Evercisesession')->orderBy('date_time', 'asc');
    }

    /**
     * @return mixed
     */
    public function futuresessions()
    {
        return $this->hasMany('Evercisesession')->where('date_time', '>=', DB::raw('NOW()'))->orderBy(
            'date_time',
            'asc'
        );

    }

    /**
     * @return mixed
     */
    public function pastsessions()
    {
        return $this->hasMany('Evercisesession')->where('date_time', '<', DB::raw('NOW()'))->orderBy(
            'date_time',
            'asc'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venue()
    {
        return $this->belongsTo('Venue');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function Sessionmember()
    {
        return $this->hasManyThrough('Sessionmember', 'Evercisesession');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * @return mixed
     */
    public function confirmed()

    {
        //return $this->belongsToMany('Trainer', 'User', 'user_id', 'user_id')->withPivot('id');
        return $this->belongsTo('Trainer', 'user_id', 'user_id')->where('confirmed', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany('Rating');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fakeRatings()
    {
        return $this->hasMany('FakeRating');
    }

    /**
     * @return mixed
     */
    public function stars()
    {
        return $this->hasMany('Rating')->select(['evercisegroup_id', 'stars']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subcategories()
    {
        return $this->belongsToMany(
            'Subcategory',
            'evercisegroup_subcategories',
            'evercisegroup_id',
            'subcategory_id'
        )->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function categories()
    {
        return $this->hasManyThrough('Category', 'Subcategory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function featuredClasses()
    {
        return $this->hasOne('FeaturedClasses');
    }

    /**
     * @return mixed
     */
    public function tester()

    {
        return $this->belongsTo('Users_groups', 'user_id', 'user_id')->where('group_id', 5);
    }

    /**
     * Concatenate Results
     * @param $resultsArray
     * @return array
     */
    public static function concatenateResults($resultsArray)
    {
        $allResults = [];

        foreach ($resultsArray as $results) {
            $theseResults = [];

            foreach ($results as $result) {
                //Remove duplicates
                if (!in_array($result, $allResults)) {
                    //$date = $result->futuresessions[0]->date_time;
                    array_push($theseResults, $result);
                }
            }
            usort($theseResults, ['Evercisegroup', "sortFunction"]);

            $allResults = array_merge($allResults, $theseResults);
        }

        return $allResults;
    }

    /**
     * Sort Sessions
     * @param $a
     * @param $b
     * @return int
     */
    public static function sortFunction($a, $b)
    {
        return strtotime($a->futuresessions[0]->date_time) - strtotime($b->futuresessions[0]->date_time);
    }

    /**
     * Get Star Rating
     *
     * @return float|int
     */
    public function getStars()
    {
        $stars = 0;
        foreach ($this->ratings as $key => $rating) {
            $stars += $rating->stars;
        }
        $stars = count($this->ratings) ? $stars / count($this->ratings) : 0;


        return $stars;
    }

    /**
     * @param $inputs
     * @return array
     */
    public static function validateAndStore($inputs)
    {
        $max_price = Config::get('values')['max_price'];
        $validator = Validator::make(
            $inputs,
            [
                'classname' => 'required|max:100|min:5',
                'description' => 'required|max:5000|min:100',
                'duration' => 'required|numeric|between:10,240',
                'maxsize' => 'required|numeric|between:1,200',
                'price' => 'required|numeric|between:1,'.$max_price,
                'image' => 'required',
                'gender' => 'required',
                'venue' => 'required',
            ]
        );
        if ($validator->fails()) {
            return [
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            ];
        } else {

            $classname = $inputs['classname'];
            $description = $inputs['description'];
            $duration = $inputs['duration'];
            $maxsize = $inputs['maxsize'];
            $price = $inputs['price'];
            $image = $inputs['image'];
            $gender = $inputs['gender'];
            $venue = $inputs['venue'];

            $category1 = $inputs['category1'];
            $category2 = $inputs['category2'];
            $category3 = $inputs['category3'];

            // Push categories into an array, and fail if there are none.
            $categories = [];
            if ($category1 != '') array_push($categories, $category1);
            if ($category2 != '') array_push($categories, $category2);
            if ($category3 != '') array_push($categories, $category3);
            if (empty($categories))
                return [
                    'validation_failed' => 1,
                    'errors' => ['category1' => 'you must choose at least one category']
                ];

            // convert array of category names into id's
            foreach ($categories as $key => $category) {
                if (!$categories[$key] = Subcategory::where('name', $category)->pluck('id'))
                    return [
                        'validation_failed' => 1,
                        'errors' => [('category' . ($key + 1)) => 'One of the categories you have chosen is not in the list']
                    ];
            }

            $evercisegroup = Evercisegroup::create([
                'name' => $classname,
                'user_id' => Sentry::getUser()->id,
                'venue_id' => $venue,
                'description' => $description,
                'default_duration' => $duration,
                'capacity' => $maxsize,
                'default_price' => $price,
                'image' => $image,
                'gender' => $gender,
                'venue_id' => $venue,
            ]);

            $evercisegroup->subcategories()->attach($categories);

            Trainerhistory::create(['user_id' => Sentry::getUser()->id, 'type' => 'created_evercisegroup', 'display_name' => Sentry::getUser()->display_name, 'name' => $evercisegroup->name]);

            Event::fire('evecisegroup.created', [Sentry::getUser(),$evercisegroup]);

            return [
                'callback' => 'gotoUrl',
                'url' => route('evercisegroups.index')
            ];
        }
    }

    public function checkIfUserOwnsClass()
    {
        if ($this->user_id != Sentry::getUser()->id)
            return false;
        else
            return true;
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public static function getById($id)
    {
        return Static::find($id);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showAsOwner()
    {
        if (!Sentry::check()) return 'Not logged in';

        if ($this['futuresessions']->isEmpty()) // Group has no sessions in the future so return 0
        {
            return 0;
        }
        else
        {
            $totalSessions = 0;
            $totalSessionMembers = 0;
            $totalCapacity = 0;
            $revenue = 0;
            $totalRevenue = 0;

            $members = [];

            foreach ($this->evercisesession as $key => $evercisesession) {
                $totalCapacity = $totalCapacity + $this->capacity;
                $members[$key] = count($evercisesession['Sessionmembers']); // Count those members
                $totalSessionMembers = $totalSessionMembers + $members[$key];
                $revenue = $revenue + ($members[$key] * $evercisesession->price);
                $totalRevenue = $totalRevenue + ($evercisesession->price * $this->capacity);
                ++$totalSessions;
            }

            $averageSessionMembers = round($totalSessionMembers / $totalSessions, 1);
            $averageCapacity = round($totalCapacity / $totalSessions, 1);
            $averageRevenue = round($revenue / $totalSessions, 1);
            $averageTotalRevenue = round($totalRevenue / $totalSessions, 1);


            return [
                'totalSessionMembers' => $totalSessionMembers,
                'totalCapacity' => $totalCapacity,
                'averageSessionMembers' => $averageSessionMembers,
                'averageCapacity' => $averageCapacity,
                'revenue' => $revenue,
                'totalRevenue' => $totalRevenue,
                'averageTotalRevenue' => $averageTotalRevenue,
                'averageRevenue' => $averageRevenue,
                'members' => $members
            ];
        }
    }

    /**
     * @return \Illuminate\View\View
     */
    public function showAsNonOwner()
    {

        try {
            $trainer = Trainer::with('user')
                ->where('user_id', $this->user_id)
                ->first();
        } catch (Exception $e) {
            /* if there is not a trainer then return to discover page */
            return 0;
        }

        /* if trainer is tester and user is not redirect */

        $testers = Sentry::findGroupByName('Tester'); // get the tester group
        $testerLoggedIn = Sentry::getUser() ? Sentry::getUser()->inGroup($testers) : false; // see if user is a tester

        $userTrainer = Sentry::findUserById($this->user_id); // create a sentry user object

        // test to see if trainer is a tester and the user is not
        if ($userTrainer->inGroup($testers) && $testerLoggedIn == false) {
            return 0;
        }

        /* if no upcoming sessions then redirect to discover page */
        if (count($this->evercisesession) == 0) {
            return 0;
        }


        // create a array containing all members
        $members = [];
        $membersIds = [];
        $memberAllIds = [];
        $memberUsers = [];
        foreach ($this->evercisesession as $key => $evercisesession) {
            $members[$evercisesession->id] = count($evercisesession['sessionmembers']); // Count those members
            foreach ($evercisesession['sessionmembers'] as $k => $sessionmember) {
                $membersIds[$evercisesession->id][] = $sessionmember->user_id;
                $memberAllIds[] = $sessionmember->user_id;
            }
        }

        if (!empty($memberAllIds)) {
            $memberUsers = User::whereIn('id', $memberAllIds)->distinct()->get();
        }


        $venue = Venue::with('facilities')->find($this->venue_id);

        $ratings = Rating::with('rator')->where('evercisegroup_id', $this->id)->orderBy('created_at')->get();
        $fakeRatings = FakeRating::with('rator')->where('evercisegroup_id', $this->id)->orderBy('created_at')->get();

        if ($memberUsers)
            $memberUsersArray = $memberUsers->toArray();
        else
            $memberUsersArray = [];

        foreach ($fakeRatings as $fakeRating) {
            if (!in_array($fakeRating->rator->id, $memberAllIds)) {
                array_push($memberUsersArray, $fakeRating->rator->toArray());
            }
        }

        // Concatinate real and fake ratings into one array
        $allRatings = array_merge($ratings->toArray(), $fakeRatings->toArray());

        /* open graph meta tags */
        /* git site https://github.com/chriskonnertz/open-graph */

        $og = new OpenGraph();

        /* try to create og if fails redirect to discover page */
        try {
            $og->title($this->name)
                ->type('article')
                ->image(url() . '/profiles/' . $trainer->user->directory . '/' . $this->image,
                    [
                        'width' => 400,
                        'height' => 200
                    ])
                ->description($this->description)
                ->url();
        } catch (Exception $e) {
            return 0;
        }


        $fakeUserGroup = Sentry::findGroupByName('Fakeuser');
        $fakeUsers = Sentry::findAllUsersInGroup($fakeUserGroup)->lists('display_name', 'id');


        JavaScript::put(['initPut' => json_encode(['selector' => '#fakerating_create'])]);
        return [
            'trainer' => $trainer,
            'members' => $members,
            'membersIds' => $membersIds,
            'memberUsers' => $memberUsersArray,
            'venue' => $venue,
            'allRatings' => $allRatings,
            'fakeUsers' => $fakeUsers,
            'og' => $og
        ];
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteGroup()
    {
        if ($this->user_id != Sentry::getUser()->id) {
            return Response::json(['mode' => 'hack']);
        }

        // Check user id against group
        if (Sentry::getUser()->id == $this->user_id) {
            // Only delete if there's no members joined
            if (count($this->sessionmember) == 0) {
                // If Evercisegroup contains Evercisesessions, delete them all.
                if (!$this['Evercisesession']->isEmpty()) {
                    foreach ($this['Evercisesession'] as $value) {
                        $value->delete();
                    }
                }

                // Now, delete actual Evercisegroup too.
                $evercisegroupForDeletion = Evercisegroup::find($this->id);
                $evercisegroupForDeletion->delete();

                Trainerhistory::create(array('user_id' => Sentry::getUser()->id, 'type' => 'deleted_evercisegroup', 'display_name' => Sentry::getUser()->display_name, 'name' => $this->name));
            }
        }
        return Response::json(['mode' => 'redirect', 'url' => Route('evercisegroups.index')]);
    }

    public static function getGroupWithSpecificSessions($evercisegroupId, $sessionIds)
    {
        return Static::with(array('evercisesession' => function ($query) use (&$sessionIds) {

            $query->whereIn('id', $sessionIds);

        }), 'evercisesession')
            ->find($evercisegroupId);

    }


}