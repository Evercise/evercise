<?php


/**
 * Class Evercisegroup
 */
class Search
{
    public static function newSearch($area, $options, $user)
    {

        $latitude = $area->lat;
        $longitude = $area->lng;


        $page = $options['page'];
        $category = (!empty($options['category']) ? $options['category'] : '');
        $radius = (!empty($options['radius']) ? $options['radius'] : '');

        $testers = Sentry::findGroupById(5);
        $testerLoggedIn = $user ? $user->inGroup($testers) : false;

        $haversine = '(3959 * acos(cos(radians(' . $latitude . ')) * cos(radians(lat)) * cos(radians(lng) - radians(' . $longitude . ')) + sin(radians(' . $latitude . ')) * sin(radians(lat))))';

        /* set the number of arrays needed per level */
        $results = [[], [], [], [], []];


        // SEARCH LEVEL 1
        $results[0] = Evercisegroup::has('futuresessions')
            ->has('confirmed')
            ->has('tester', '<', $testerLoggedIn ? 5 : 1)// testing to make sure class does not belong to the tester
            ->Location($latitude, $longitude, $radius)
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
                ->Location($latitude, $longitude, $radius)
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
                ->Location($latitude, $longitude, $radius)
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
                ->Location($latitude, $longitude, $radius)
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
                ->Location($latitude, $longitude, $radius)
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
                ) // testing to make sure class does not belong to the tester
                ->with('venue')
                ->whereHas(
                    'venue',
                    function ($query) use (&$haversine, &$radius) {
                        $query->select(array(DB::raw($haversine . ' as distance')))
                            ->having('distance', '<', $radius);
                    }
                )
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
        $mapResult = [];
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

//
//        echo "<br/>PAGE: ";
//        print_r($page);
//        echo "<br/>CAT: ";
//        print_r($category);
//        echo "<br/>HAV: ";
//        print_r($haversine);
//        echo "<br/>RAD: ";
//        print_r($radius);
//        echo "<pre>";
//        print_r(DB::getQueryLog());
//        die();
        return View::make('evercisegroups.search')
            ->with('places', json_encode($mapResult))
            ->with('evercisegroups', $paginatedResults);
    }
}