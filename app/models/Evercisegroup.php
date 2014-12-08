<?php
use Carbon\Carbon;

/**
 * Class Evercisegroup
 */
class Evercisegroup extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'venue_id',
        'name',
        'title',
        'slug',
        'description',
        'image',
        'gender',
        'capacity',
        'default_duration',
        'default_price',
        'published'
    ];

    protected $editable = [
        'name',
        'venue_id',
        'description',
        'image',
        'category1',
        'category2',
        'category3',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evercisegroups';

    private static function validateInputs($inputs)
    {

        $validator = Validator::make(
            $inputs,
            [
                'class_name'        => 'required|max:50|min:3',
                'class_description' => 'required|max:500|min:50',
                'image'             => 'required',
                'venue_select'      => 'required',
            ]
        );

        return $validator;
    }

    /**
     * @param $inputs
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validateAndStore($inputs, $user)
    {
        $validator = static::validateInputs($inputs);


        if ($validator->fails()) {
            $result = [
                'validation_failed' => 1,
                'errors'            => $validator->errors()->toArray()
            ];

            return Response::json($result);
        } else {

            $classname = $inputs['class_name'];
            $description = $inputs['class_description'];
            $image = $inputs['image'];

            if($inputs['gallery_image'] == 'true') {
                $image = Gallery::selectImage($image, $user, $classname);
            }


            $venueId = $inputs['venue_select'];

            // Push categories into an array, and fail if there are none.
            //$categories = static::categoriesToArray($inputs);
            $categories = $inputs['category_array'];

            if (empty($categories)) {
                return Response::json(
                    ['validation_failed' => 1, 'errors' => ['category1' => 'you must choose at least one category']]
                );
            }

            $evercisegroup = static::create(
                [
                    'name'        => $classname,
                    'user_id'     => $user->id,
                    'venue_id'    => $venueId,
                    'description' => $description,
                    'image'       => $image,
                    'slug'        => str_random(10),
                ]
            );

            $evercisegroup->subcategories()->attach($categories);

            Trainerhistory::create(
                [
                    'user_id'      => $user->id,
                    'type'         => 'created_evercisegroup',
                    'display_name' => $user->display_name,
                    'name'         => $evercisegroup->name
                ]
            );

            event('class.created', [$evercisegroup, $user]);

            return Response::json(
                [
                    'url'     => route('sessions.add', $evercisegroup->id),
                    'success' => 'true',
                    'id'      => $evercisegroup->id
                ]
            );
        }
    }

    private static function categoriesToArray($inputs)
    {
        $categories = [];
        if (isset($inputs['category1']) != '') {
            array_push($categories, $inputs['category1']);
        }
        if (isset($inputs['category2']) != '') {
            array_push($categories, $inputs['category2']);
        }
        if (isset($inputs['category3']) != '') {
            array_push($categories, $inputs['category3']);
        }

        return $categories;
    }

    public function validateAndUpdate($inputs, $user)
    {
        $validator = static::validateInputs($inputs);

        if ($validator->fails()) {
            return Response::json([
                'validation_failed' => 1,
                'errors'            => $validator->errors()->toArray()
            ]);
        } else {
            /*            foreach ($inputs as $name => $value) {
                            if (!in_array($name, $this->editable)) {
                                return Response::json([
                                    'validation_failed' => 1,
                                    'errors' => ['classname' => 'Trying to edit uneditable/non-existant field: ' . $name]
                                ]);
                            }
                        }*/

            $classname = $inputs['class_name'];
            $description = $inputs['class_description'];
            $image = $inputs['image'];
            $venueId = $inputs['venue_select'];

            // Push categories into an array, and fail if there are none.
            //$categories = static::categoriesToArray($inputs);
            $categories = $inputs['category_array'];

            $this->update([
                'name'        => $classname,
                'venue_id'    => $venueId,
                'description' => $description,
                'image'       => $image,
            ]);


            if (!empty($categories)) {
                $this->subcategories()->sync($categories);
            }

            Trainerhistory::create(
                [
                    'user_id'      => $user->id,
                    'type'         => 'edited_evercisegroup',
                    'display_name' => $user->display_name,
                    'name'         => $this->name
                ]
            );

            event('class.updated', [$user, $this]);


        }

        return TRUE;

    }


    private $classStats = [];

    /**
     * @param $user
     * @return \Illuminate\View\View
     */
    public static function getUserHub($user)
    {
        $currentDate = new DateTime();
        $sessionmember_ids = []; // For rating
        $pastSessions = [];
        $futureSessions = [];
        $nextSessions = []; // Links past session with the next Future session (of the same group) which this member has signed up for

        $pastSessionsAwaitingFutureBuddy = [];
        foreach ($user->sessions as $key => $session) {
            // Past sessions
            if (new DateTime($session->date_time) < $currentDate) {
                if (!array_key_exists($session->id, $futureSessions)) {
                    $pastSessions[$session->id] = $session;
                }
                foreach ($session->sessionmembers as $sessionmember) {
                    $sessionmember_ids[$session->id] = $sessionmember->id;
                }

                $pastSessionsAwaitingFutureBuddy[$session->evercisegroup->id] = $session->id;
            } // Future sessions
            else {
                if (!array_key_exists($session->id, $futureSessions)) {
                    $futureSessions[$session->id] = $session;
                }

                if (array_key_exists($session->evercisegroup->id, $pastSessionsAwaitingFutureBuddy)) {
                    $nextSessions[$pastSessionsAwaitingFutureBuddy[$session->evercisegroup->id]] = $session->id;
                }

            }

        }


        $data = [
            'past_sessions'     => $pastSessions,
            'future_sessions'   => $futureSessions,
            'sessionmember_ids' => $sessionmember_ids,
            'user_id'           => $user->id,
            'next_sessions'     => $nextSessions,
        ];

        return $data;
    }

    public static function getTrainerHub($user)
    {
        $data = static::getUserHub($user);

        $trainerGroups = static::with('evercisesession.sessionmembers')
            ->with('futuresessions.sessionmembers')
            ->with('pastsessions')
            ->with('venue')
            ->where('user_id', $user->id)->get();

        $data = array_merge($data, [
            'trainer_groups' => $trainerGroups ?: [],
        ]);

        return $data;
    }

    public static function parseSegments($segments)
    {


        /** Is this a permalink or something  */
        if (!empty($segments[2])) {

            /**
             * If we get more Users.. this entire thing should be cached as one array just used like that
             * For now i wont do that
             */


            $default['type'] = 'search';
            $default['sub_type'] = 'station';

            if (!empty($segments[3])) {
                $default['location'] = $segments[3];
            } else {
                throw new \Exception('No Location Defined');
            }

            return $default;
        }


        return $default;
    }

    /**
     * @param $location
     * @param $category
     * @param $radius
     * @param $user
     * @return \Illuminate\View\View
     */
    public static function newSearch($options, $user)
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


        $page = Input::get('page', 1);

        $testers = Sentry::findGroupById(5);
        $testerLoggedIn = $user ? $user->inGroup($testers) : FALSE;

        $haversine = '(3959 * acos(cos(radians(' . $latitude . ')) * cos(radians(lat)) * cos(radians(lng) - radians(' . $longitude . ')) + sin(radians(' . $latitude . ')) * sin(radians(lat))))';

        /* set the number of arrays needed per level */
        $results = [[], [], [], [], []];

        // SEARCH LEVEL 1
        $results[0] = Evercisegroup::has('futuresessions')
            ->has('confirmed')
            ->has('tester', '<', $testerLoggedIn ? 5 : 1)// testing to make sure class does not belong to the tester
            ->where(
                'venue',
                function ($query) use (&$haversine, &$radius) {
                    $query->select([DB::raw($haversine . ' as distance')])
                        ->having('distance', '<', $radius);
                }
            )
            ->whereHas(
                'subcategories',
                function ($query) use ($category) {
                    $query->where('name', 'LIKE', '%' . $category . '%');
                }
            )
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
                ->whereHas(
                    'venue',
                    function ($query) use (&$haversine, &$radius) {
                        $query->select([DB::raw($haversine . ' as distance')])
                            ->having('distance', '<', $radius);
                    }
                )
                ->whereHas(
                    'subcategories',
                    function ($query) use ($category) {

                        $query->whereHas(
                            'categories',
                            function ($subquery) use ($category) {
                                $subquery->where('name', 'LIKE', '%' . $category . '%');
                            }
                        );
                    }
                )
                //->with('categories')
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        //return var_dump($level2results);

        // SEARCH LEVEL 3 ( if level 1 and level 2 return less than 9 results)
        if (count($results[0]) + count($results[1]) < 9) {
            $results[2] = Evercisegroup::has('futuresessions')
                ->has('confirmed')
                ->has('tester', '<', $testerLoggedIn ? 5 : 1)// testing to make sure class does not belong to the tester
                ->whereHas(
                    'venue',
                    function ($query) use (&$haversine, &$radius) {
                        $query->select([DB::raw($haversine . ' as distance')])
                            ->having('distance', '<', $radius);
                    }
                )
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
                ->whereHas(
                    'venue',
                    function ($query) use (&$haversine, &$radius) {
                        $query->select([DB::raw($haversine . ' as distance')])
                            ->having('distance', '<', $radius);
                    }
                )
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
                ->whereHas(
                    'venue',
                    function ($query) use (&$haversine, &$radius) {
                        $query->select([DB::raw($haversine . ' as distance')])
                            ->having('distance', '<', $radius);
                    }
                )
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        // SEARCH LEVEL 6
        if (count($results[0]) + count($results[1]) + count($results[2]) + count($results[3]) + count(
                $results[4]
            ) < 9
        ) {
            $results[5] = Evercisegroup::has('futuresessions')
                ->has('confirmed')
                ->has(
                    'tester',
                    '<',
                    $testerLoggedIn ? 5 : 1
                )// testing to make sure class does not belong to the tester
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        $allResults = Evercisegroup::concatenateResults($results);

        $perPage = 12;


        if ($page > count($allResults) or $page < 1) {
            $page = 1;
        }
        $offset = ($page * $perPage) - $perPage;
        $articles = array_slice($allResults, $offset, $perPage);
        $paginatedResults = Paginator::make($articles, count($allResults), $perPage);

        foreach ($allResults as $result) {
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


        return View::make('evercisegroups.search')
            ->with('places', json_encode($mapResult))
            ->with('evercisegroups', $paginatedResults);
    }


    /**
     * @param $location
     * @param $category
     * @param $radius
     * @param $user
     * @return \Illuminate\View\View
     */
    public static function doSearch($location, $category, $radius, $user)
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


        $page = Input::get('page', 1);

        $testers = Sentry::findGroupById(5);
        $testerLoggedIn = $user ? $user->inGroup($testers) : FALSE;

        $haversine = '(3959 * acos(cos(radians(' . $latitude . ')) * cos(radians(lat)) * cos(radians(lng) - radians(' . $longitude . ')) + sin(radians(' . $latitude . ')) * sin(radians(lat))))';

        /* set the number of arrays needed per level */
        $results = [[], [], [], [], []];

        // SEARCH LEVEL 1
        $results[0] = Evercisegroup::has('futuresessions')
            ->has('confirmed')
            ->has('tester', '<', $testerLoggedIn ? 5 : 1)// testing to make sure class does not belong to the tester
            ->whereHas(
                'venue',
                function ($query) use (&$haversine, &$radius) {
                    $query->select([DB::raw($haversine . ' as distance')])
                        ->having('distance', '<', $radius);
                }
            )
            ->whereHas(
                'subcategories',
                function ($query) use ($category) {
                    $query->where('name', 'LIKE', '%' . $category . '%');
                }
            )
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
                ->whereHas(
                    'venue',
                    function ($query) use (&$haversine, &$radius) {
                        $query->select([DB::raw($haversine . ' as distance')])
                            ->having('distance', '<', $radius);
                    }
                )
                ->whereHas(
                    'subcategories',
                    function ($query) use ($category) {

                        $query->whereHas(
                            'categories',
                            function ($subquery) use ($category) {
                                $subquery->where('name', 'LIKE', '%' . $category . '%');
                            }
                        );
                    }
                )
                //->with('categories')
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        //return var_dump($level2results);

        // SEARCH LEVEL 3 ( if level 1 and level 2 return less than 9 results)
        if (count($results[0]) + count($results[1]) < 9) {
            $results[2] = Evercisegroup::has('futuresessions')
                ->has('confirmed')
                ->has('tester', '<', $testerLoggedIn ? 5 : 1)// testing to make sure class does not belong to the tester
                ->whereHas(
                    'venue',
                    function ($query) use (&$haversine, &$radius) {
                        $query->select([DB::raw($haversine . ' as distance')])
                            ->having('distance', '<', $radius);
                    }
                )
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
                ->whereHas(
                    'venue',
                    function ($query) use (&$haversine, &$radius) {
                        $query->select([DB::raw($haversine . ' as distance')])
                            ->having('distance', '<', $radius);
                    }
                )
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
                ->whereHas(
                    'venue',
                    function ($query) use (&$haversine, &$radius) {
                        $query->select([DB::raw($haversine . ' as distance')])
                            ->having('distance', '<', $radius);
                    }
                )
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        // SEARCH LEVEL 6
        if (count($results[0]) + count($results[1]) + count($results[2]) + count($results[3]) + count(
                $results[4]
            ) < 9
        ) {
            $results[5] = Evercisegroup::has('futuresessions')
                ->has('confirmed')
                ->has(
                    'tester',
                    '<',
                    $testerLoggedIn ? 5 : 1
                )// testing to make sure class does not belong to the tester
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        }

        $allResults = Evercisegroup::concatenateResults($results);

        $perPage = 12;


        if ($page > count($allResults) or $page < 1) {
            $page = 1;
        }
        $offset = ($page * $perPage) - $perPage;
        $articles = array_slice($allResults, $offset, $perPage);
        $paginatedResults = Paginator::make($articles, count($allResults), $perPage);

        foreach ($allResults as $result) {
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


        return View::make('evercisegroups.search')
            ->with('places', json_encode($mapResult))
            ->with('evercisegroups', $paginatedResults);
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
        if (!empty($categories)) {
            $evercisegroup->subcategories()->attach($categories);
        }
    }

    /**
     * @param $featured
     */
    public function adminMakeClassFeatured($featured)
    {
        if ($featured) {
            FeaturedClasses::firstOrCreate(['evercisegroup_id' => $this->id]);
        } else {
            $id = FeaturedClasses::where('evercisegroup_id', $this->id)->pluck('id');
            if ($id) {
                FeaturedClasses::destroy($id);
            }
        }
    }

    /**
     * @return mixed
     */
    public function evercisesession()
    {
        return $this->hasMany('Evercisesession')->orderBy('date_time', 'asc');
    }

    /**
     * @return mixed
     */
    public function futuresessions()
    {
        return $this->hasMany('Evercisesession')->where('date_time', '>=', Carbon::now())->orderBy(
            'date_time',
            'asc'
        );
    }

    /**
     * @return mixed
     */
    public function getNextFutureSession()
    {
        return $this->hasMany('Evercisesession')
            ->where('date_time', '>=', Carbon::now())
            ->first();
    }

    /**
     * @return mixed
     */
    public function pastsessions()
    {
        return $this->hasMany('Evercisesession')->where('date_time', '<', Carbon::now())->orderBy(
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

    public function getSubcategoryIds()
    {
        return $this->subcategories->lists('id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function categories()
    {
        return $this->hasManyThrough('Category', 'Subcategory');
    }

    public function scopeLocation($query, $latitude, $longitude, $radius = 1)
    {
        $haversine = '(3959 * acos(cos(radians(' . $latitude . ')) * cos(radians(lat)) * cos(radians(lng) - radians(' . $longitude . ')) + sin(radians(' . $latitude . ')) * sin(radians(lat))))';

        return $query->whereIn(
            'venue_id',
            function ($query) use ($haversine, $radius) {
                $query->select('id')
                    ->from(with(new Venue)->getTable())
                    ->where(DB::raw($haversine), '<=', $radius);
            }
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function featuredClasses()
    {
        return $this->hasOne('FeaturedClasses');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function slider()
    {
        return $this->hasOne('Slider');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function isFeatured()
    {
        return FeaturedClasses::where('evercisegroup_id', $this->id)->first();
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
                    $date = $result->futuresessions[0]->date_time;
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
        if (isset($this->classStats['stars'])) {
            return $this->classStats['stars'];
        }

        $stars = 0;
        foreach ($this->ratings as $key => $rating) {
            $stars += $rating->stars;
        }
        $stars = count($this->ratings) ? $stars / count($this->ratings) : 0;

        $this->classStats['stars'] = $stars;

        return $stars;
    }

    public function placesFilled()
    {
        $members = [];
        foreach ($this->futuresessions as $evercisesession) {
            $members[] = count($evercisesession->sessionmembers);
        }

        return array_sum($members);
    }

    public function averageClassBooking()
    {
        $members = [];
        foreach ($this->evercisesession as $evercisesession) {
            $members[] = count($evercisesession->sessionmembers);
        }
        if (count($members) > 0) {
            $average = round(array_sum($members) / count($members));
        } else {
            $average = 0;
        }

        return $average;
    }

    public function checkIfUserOwnsClass($user)
    {
        if ($this->user_id != $user->id) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public static function getById($id)
    {
        return static::find($id);
    }

    /**
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showAsOwner($user)
    {

        if ($this->user_id == $user->id) {
            //$evercisegroup_id;
            if (!Sentry::check()) {
                return 'Not logged in';
            }

            $directory = $user->directory;


            if ($this['futuresessions']->isEmpty()) {

                return View::make('evercisegroups.trainer_show')
                    ->with('evercisegroup', $this)
                    ->with('directory', $directory)
                    ->with('members', 0);
            } else {
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


                return View::make('evercisegroups.trainer_show')
                    ->with('evercisegroup', $this)
                    ->with('directory', $directory)
                    ->with('totalSessionMembers', $totalSessionMembers)
                    ->with('totalCapacity', $totalCapacity)
                    ->with('averageSessionMembers', $averageSessionMembers)
                    ->with('averageCapacity', $averageCapacity)
                    ->with('revenue', $revenue)
                    ->with('totalRevenue', $totalRevenue)
                    ->with('averageTotalRevenue', $averageTotalRevenue)
                    ->with('averageRevenue', $averageRevenue)
                    ->with('members', $members);
            }

        }

        JavaScript::put(['initPut' => json_encode(['selector' => '#fakerating_create'])]);

        return View::make('evercisegroups.show')
            ->with('evercisegroup', $this); // change to trainer show view
    }

    /**
     * @param $user
     * @return \Illuminate\View\View
     */
    public function showAsNonOwner($user)
    {

        try {
            $trainer = Trainer::with('user')
                ->where('user_id', $this->user_id)
                ->first();
        } catch (Exception $e) {
            /* if there is not a trainer then return to discover page */
            return Redirect::route('evercisegroups.search');
        }

        /* if trainer is tester and user is not redirect */

        $testers = Sentry::findGroupById(5); // get the tester group

        $testerLoggedIn = $user ? $user->inGroup($testers) : FALSE; // see if user is a tester

        $userTrainer = Sentry::findUserById($this->user_id); // create a sentry user object

        // test to see if trainer is a tester and the user is not
        if ($userTrainer->inGroup($testers) && $testerLoggedIn == FALSE) {
            return Redirect::route('evercisegroups.search');
        }

        /* if no upcoming sessions then redirect to discover page */
        if (count($this->evercisesession) == 0) {
            return Redirect::route('evercisegroups.search');
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

        if ($memberUsers) {
            $memberUsersArray = $memberUsers->toArray();
        } else {
            $memberUsersArray = [];
        }

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
                ->image(
                    url() . $trainer->user->directory . '/thumb_' . $this->image
                )
                ->description($this->description)
                ->url();
        } catch (Exception $e) {
            return Redirect::route('evercisegroups.search');
        }


        $fakeUserGroup = Sentry::findGroupByName('Fakeuser');
        $fakeUsers = Sentry::findAllUsersInGroup($fakeUserGroup)->lists('display_name', 'id');


        JavaScript::put(['initPut' => json_encode(['selector' => '#fakerating_create'])]);

        JavaScript::put(['initPut' => json_encode(['selector' => '#add-to-cart'])]);

        return [
            'evercisegroup' => $this,
            'trainer'       => $trainer,
            'members'       => $members,
            'membersIds'    => $membersIds,
            'memberUsers'   => $memberUsersArray,
            'venue'         => $venue,
            'allRatings'    => $allRatings,
            'fakeUsers'     => $fakeUsers,
            'og'            => $og,
        ];
    }

    /**
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteGroup($user)
    {
        if ($this->user_id != $user->id) {
            return Response::json(['mode' => 'hack']);
        }

        // Check user id against group
        if ($user->id == $this->user_id) {
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


                Trainerhistory::create(
                    [
                        'user_id'      => $user->id,
                        'type'         => 'deleted_evercisegroup',
                        'display_name' => $user->display_name,
                        'name'         => $this->name
                    ]
                );
            }
        }

        return Response::json(['mode' => 'redirect', 'url' => route('evercisegroups.index')]);
    }


    public static function getGroupWithSpecificSessions($evercisegroupId, $sessionIds)
    {
        return static::with(
            [
                'evercisesession' => function ($query) use (&$sessionIds) {

                    $query->whereIn('id', $sessionIds);

                }
            ],
            'evercisesession'
        )
            ->find($evercisegroupId);

    }

    public static function editSubcats($subcatChanges)
    {

        foreach ($subcatChanges as $subcat) {
            foreach ($subcat as $key => $subcatData) {
                $evercisegroup = static::find($key);
                if ($evercisegroup) {
                    $evercisegroup->subcategories()->detach();
                    if (!empty($subcatData)) {
                        $subcatNames = explode(',', $subcatData);
                        $subcatIds = [];
                        foreach ($subcatNames as $subcatName) {
                            array_push($subcatIds, Subcategory::where('name', $subcatName)->pluck('id'));
                        }
                        $evercisegroup->subcategories()->attach($subcatIds);

                    }
                }
            }
        }

        return TRUE;
    }

    public function publish($publish)
    {
        $this->published = $publish ? 1 : 0;
        $this->save();
    }

    public static function getSlug($id)
    {
        return static::find($id)->slug;
    }


}