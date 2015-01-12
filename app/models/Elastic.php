<?php

/**
 * Simple Class that interacts with the Elastic Search engine
 */
class Elastic
{


    /**
     * @var Evercisegroup
     */
    protected $evercisegroup;
    /**
     * @var Geotools
     */
    protected $geotools;
    /**
     * @var Es
     */
    protected $elasticsearch;
    /**
     * @var Illuminate\Log\Writer
     */
    protected $log;


    /**
     * Inject all used classes.. Set defaults just in case
     *
     * @param $evercisegroup
     * @param $geotools
     * @param $elasticsearch
     * @param $log
     */
    public function __construct($geotools, $evercisegroup, $elasticsearch, $log)
    {
        $this->geotools = $geotools;
        $this->evercisegroup = $evercisegroup;
        $this->elasticsearch = $elasticsearch;
        $this->log = $log;


        $this->elastic_index = (getenv('ELASTIC_INDEX') ?: 'evercise');
        $this->elastic_type = (getenv('ELASTIC_TYPE') ?: 'evercise');
        $this->elastic_polygon = getenv('ELASTIC_POLYGON');
    }

    /**
     * Search Evercisegroups Index
     *
     * @param Place $area
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function searchEvercisegroups(Place $area, $params = [])
    {
        $searchParams['index'] = $this->elastic_index;
        $searchParams['type'] = $this->elastic_type;

        $searchParams['size'] = $params['size'];
        $searchParams['from'] = $params['from'];

        /** Are we going to Search Something? */

        $search = FALSE;

        $searchParams['body']['min_score'] = getenv('ELASTIC_MINIMAL_SCORE') ?: 0.15;


        if (!empty($params['search'])) {
            $searchParams['body']['query']['filtered']['query'] = [

                'flt' => [
                    'like_text'       => $params['search'],
                    'max_query_terms' => 12,

                ],

            ];
            $search = TRUE;
        }

        if (!isset($params['all'])) {
            $searchParams['body']['query']['filtered']['filter']['bool']['must'][]["term"] = ['published' => TRUE];
            $searchParams['body']['query']['filtered']['filter']['bool']['must'][]["range"] = ['futuresessions.date_time' => ['gte' => date('Y-m-d H:i:s')]];
            $searchParams['body']['query']['filtered']['filter']['bool']['must_not']['missing'] = [
                'field'      => 'futuresessions.members',
                'existence'  => TRUE,
                'null_value' => TRUE
            ];
            $search = TRUE;
        }


        if (!empty($params['featured'])) {
            $searchParams['body']['query']['filtered']['filter']['bool']['must'][]["term"] = ['featured' => TRUE];
            $search = TRUE;
        }


        if (!$search) {
            /** Guess not! */
            $searchParams['body']['query']['filtered']['query']['match_all'] = [];
        }


        if (!empty($params['sort'])) {
            $searchParams['body']['sort'] = $params['sort'];
        }


        /** What Are we Searching For */
        if ($area->coordinate_type == 'polygon' && !empty($area->poly_coordinates) && $this->elastic_polygon) {

            $location_points = [];

            foreach (json_decode($area->poly_coordinates) as $part) {
                try {
                    $location_points[] = $this->getLocationHash($part[0], $part[1]);
                } catch (Exception $e) {
                    $this->log->error(
                        'GeoHash cant hash Area ' . $area->id . ' for lat_lon ' . $part[0] . ', ' . $part[1]
                    );
                }

            }

            if (count($location_points) > 0) {
                $searchParams['body']['query']['filtered']['filter']['bool']['must'][]['geo_polygon']['venue.location']['points'] = $location_points;
            } else {

                $this->log->error('Area ' . $area->id . ' is set to be Polygon but has 0 valid datapoints');
            }

        } else {

            if (!empty($area->lat) && !empty($area->lng)) {
                $searchParams['body']['query']['filtered']['filter']['bool']['must'][]['geo_distance'] = [
                    'distance'       => $params['radius'],
                    'venue.location' => $this->getLocationHash($area->lat, $area->lng)
                ];
            }
        }


        $result = $this->elasticsearch->search($searchParams)['hits'];

        $result_object = json_decode(json_encode($result), FALSE);

        return $result_object;

    }


    /**
     * Search Evercisegroups Index
     *
     * @param Place $area
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function searchStats($params = [])
    {
        $searchParams['index'] = 'search_stats';
        $searchParams['type'] = 'search';

        $searchParams['size'] = $params['size'];
        $searchParams['from'] = $params['from'];

        /** Are we going to Search Something? */
        if (!empty($params['search'])) {
            $searchParams['body']['query']['filtered']['query'] = [

                'flt' => [
                    'like_text'       => $params['search'],
                    'max_query_terms' => 12,

                ],

            ];
        } else {
            /** Guess not! */
            $searchParams['body']['query']['filtered']['query']['match_all'] = [];
        }


        $result = $this->elasticsearch->search($searchParams)['hits'];

        $result_object = json_decode(json_encode($result), FALSE);


        return $result_object;

    }


    /**
     * @param int $id
     * @return mixed
     */
    public  function getSingle($id = 0)
    {
        $searchParams['index'] = $this->elastic_index;
        $searchParams['type'] = $this->elastic_type;

        $searchParams['size'] = 1;
        $searchParams['from'] = 0;

        if (is_numeric($id)) {
            $searchParams['body']['query']['match'] = ['id' => $id];
        } else {
            $searchParams['body']['query']['match'] = ['slug' => $id];
        }

        $result = $this->elasticsearch->search($searchParams)['hits'];

        $result_object = json_decode(json_encode($result), FALSE);

        return $result_object;

    }


    /**
     * Encode Latitude and Longtitude into GEOHASH
     *
     * @param bool $lat
     * @param bool $lon
     * @throws Exception
     */
    public function getLocationHash($lat = FALSE, $lon = FALSE)
    {
        try {
            $geohash = $this->geotools->coordinate($lat . ',' . $lon);
            $encoded = $this->geotools->geohash()->encode($geohash);

            return $encoded->getGeohash();
        } catch (Exception $e) {
            throw new Exception('Cant GeoHash ' . $lat . ', ' . $lon);
        }
    }


    /**
     * Decode Location GEOHASH
     *
     * @param bool $geohash
     * @throws Exception
     */
    public function decodeLocationHash($geohash = FALSE)
    {
        try {
            $decoded = $this->geotools->geohash()->decode($geohash);

            return [
                'latitude'   => $decoded->getCoordinate()->getLatitude(),
                'longtitude' => $decoded->getCoordinate()->getLongitude()
            ];
        } catch (Exception $e) {
            throw new Exception('Cant decode GEOHASH ' . $geohash);
        }
    }


    /**
     * @return bool
     */
    public function indexEvercisegroups($id = 0)
    {

        $total_indexed = 0;
        $with_session = 0;

        $this->log->info('Indexing Evercise Groups started ' . date('d H:i:s'));

        if ($id == 0) {
            $all = $this->evercisegroup->with('futuresessions')
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->get();
        } else {
            $all = $this->evercisegroup->with('futuresessions')
                ->with('venue')
                ->with('user')
                ->with('ratings')
                ->with('futuresessions')
                ->where('id', $id)
                ->get();
        }

        $this->log->info('Get all Indexing data ' . date('d H:i:s'));
        foreach ($all as $a) {

            if (!empty($a->venue->lat) && !empty($a->venue->lng)) {
                $geohash = $this->geotools->coordinate($a->venue->lat . ',' . $a->venue->lng);
                $encoded = $this->geotools->geohash()->encode($geohash);
                $hash = $encoded->getGeohash();
            } else {
                $hash = '';
            }


            $index = [
                'id'               => (int)$a->id,
                'user_id'          => (int)$a->user_id,
                'venue_id'         => (int)$a->venue_id,
                'counter'          => (int)$a->counter,
                'name'             => $a->name,
                'title'            => $a->title,
                'slug'             => $a->slug,
                'gender'           => $a->gender,
                'description'      => $a->description,
                'image'            => $a->image,
                'capacity'         => round($a->futuresessions()->avg('tickets'), 0),
                'default_duration' => (int)$a->default_duration,
                'default_price'    => (double)$a->default_price,
                'published'        => ($a->published == 0 ? FALSE : TRUE),
                'featured'         => ($a->isfeatured() ? TRUE : FALSE),
                'user'             => [
                    'id'           => (int)$a->user->id,
                    'email'        => $a->user->email,
                    'first_name'   => $a->user->first_name,
                    'last_name'    => $a->user->last_name,
                    'display_name' => $a->user->display_name,
                    'image'        => $a->user->image,
                    'directory'    => $a->user->directory,
                    'phone'        => $a->user->phone,
                ],
                'venue'            => [
                    'id'       => (int)$a->venue->id,
                    'name'     => $a->venue->name,
                    'address'  => $a->venue->address,
                    'postcode' => $a->venue->postcode,
                    'town'     => $a->venue->town,
                    'lat'      => $a->venue->lat,
                    'lon'      => $a->venue->lng,
                    'location' => [
                        'geohash' => $hash,
                    ],
                    'image'    => $a->venue->image
                ],
                'ratings'          => [],
                'futuresessions'   => []
            ];

            foreach ($a->ratings as $s) {

                $user = $s->rator;
                $index['ratings'][] = [
                    'user_id'   => (int)$s->user_id,
                    'image'     => $user->directory . '/small_' . $user->image,
                    'name'      => $user->first_name . ' ' . $user->last_name,
                    'stars'     => (int)$s->stars,
                    'comment'   => $s->comment,
                    'date_left' => $s->created_at->format('M jS, g:ia')
                ];

            }

            $price = 0;

            foreach ($a->futuresessions()->orderBy('date_time', 'asc')->get() as $s) {


                if ($price == 0) {
                    $price = (double)$s->price;
                }

                if ($price > (double)$s->price) {
                    $price = (double)$s->price;
                }

                $index['futuresessions'][] = [
                    'id'              => (int)$s->id,
                    'members'         => (int)$s->members,
                    'date_time'       => $s->date_time->toDateTimeString(),
                    'price'           => (double)$s->price,
                    'duration'        => (int)$s->duration,
                    'members_emailed' => (int)$s->members_emailed,
                    'tickets'         => (int)$s->tickets,
                    'remaining'       => (int)$s->remainingTickets(),
                    'default_tickets' => 1
                ];
                $with_session++;
            }


            /** Categories */
            $categories = [];


            foreach ($a->subcategories()->get() as $sub) {
                if (!in_array($sub->name, $categories)) {
                    $categories[] = $sub->name;
                    if(!empty($sub->associations)) {
                        $categories[] = $sub->associations;
                    }

                }

                foreach ($sub->categories()->get() as $cat) {
                    if (!in_array($cat->name, $categories)) {
                        $categories[] = $cat->name;
                    }
                }
            }

            $index['categories'] = implode(', ', $categories);

            if ($price > 0) {
                $index['default_price'] = $price;
            }

            $params = [];
            $params['body'] = $index;

            $params['index'] = $this->elastic_index;
            $params['type'] = $this->elastic_type;
            $params['id'] = $a->id;


            try {
                $this->elasticsearch->index($params);
                $total_indexed++;
            } catch (Exception $e) {
                $this->log->error('Cant Index Elasticgroup::id(' . $a->id . ') row. Got error: ' . $e->getMessage());
            }
        }

        $this->log->info('Indexing Completed ' . date('d H:i:s'));

        return $total_indexed . ' ' . $with_session;


    }


    /**
     * Save Search Stats to elastic.. we will use this later
     * @param $user_id
     * @param $user_ip
     * @param $area
     * @param array $params
     * @param int $results
     */
    public function saveStats($user_id = 0, $user_ip = 0, Place $area, $params = [], $results = 0)
    {


        try {
            $data = [

                'index' => 'search_stats',
                'type'  => 'search',
                'id'    => str_random(20),
                'body'  => [
                    'search'   => $params['search'],
                    'size'     => $params['size'],
                    'user_id'  => $user_id,
                    'user_ip'  => $user_ip,
                    'radius'   => $params['radius'],
                    'url'      => $area->link->permalink,
                    'url_type' => $area->link->type,
                    'name'     => $area->name,
                    'lat'      => $area->lat,
                    'lng'      => $area->lng,
                    'results'  => $results,
                    'date'     => date('Y-m-d H:i:s')
                ]
            ];

            $this->elasticsearch->index($data);


        } catch (Exception $e) {
            // Log it and move on Do Nothing...
            $this->log->error('SEARCH INDEX ERROR: ' . $e->getMessage());
        }


    }


    /**
     * @param $id
     * @return array
     */
    public function deleteSingle($id)
    {
        return $this->elasticsearch->delete(
            ['id' => $id, 'type' => $this->elastic_type, 'index' => $this->elastic_index]
        );
    }

    /**
     * @param string $index
     * @param string $type
     * @return array|bool
     */
    public function resetIndex($index = FALSE, $type = FALSE)
    {

        $mapping = [];

        $params['index'] = ($index ?: $this->elastic_index);
        $params['type'] = ($type ?: $this->elastic_type);


        switch ($type) {
            case 'evercise':
                $mapping = [
                    '_source'    => ['enabled' => TRUE],
                    'properties' => [

                        '_all'             => ['enabled' => TRUE],
                        'id'               => [
                            'type'           => 'string',
                            'index'          => 'not_analyzed',
                            'include_in_all' => FALSE
                        ],
                        'slug'             => ['type' => 'string', 'include_in_all' => FALSE],
                        'name'             => ['type' => 'string', 'index' => 'analyzed', 'include_in_all' => TRUE],
                        'counter'          => ['type' => 'string', 'index' => 'analyzed', 'include_in_all' => TRUE],
                        'title'            => ['type' => 'string', 'index' => 'analyzed', 'include_in_all' => TRUE],
                        'venue_id'         => ['type' => 'integer', 'include_in_all' => TRUE],
                        'user_id'          => ['type' => 'integer', 'include_in_all' => TRUE],
                        'gender'           => ['type' => 'integer'],
                        'categories'       => ['type' => 'string'],
                        'default_price'    => ['type' => 'integer'],
                        'capacity'         => ['type' => 'integer'],
                        'default_duration' => ['type' => 'integer'],
                        'published'        => ['type' => 'boolean'],
                        'description'      => ['type' => 'string', 'index' => 'analyzed', 'include_in_all' => TRUE],
                        'image'            => ['type' => 'string'],
                        'venue'            => [
                            'dynamic'    => TRUE,
                            'properties' => [
                                'id'       => ['type' => 'integer'],
                                'name'     => ['type' => 'string', 'include_in_all' => TRUE],
                                'address'  => ['type' => 'string', 'include_in_all' => TRUE],
                                'postcode' => ['type' => 'string', 'include_in_all' => TRUE],
                                'town'     => ['type' => 'string', 'include_in_all' => TRUE],
                                'location' => [
                                    'type'      => 'geo_point',
                                    'geohash'   => TRUE,
                                    'lat_lon'   => TRUE,
                                    'fielddata' => [
                                        'format' => 'compressed'
                                    ]
                                ]
                            ]
                        ],
                        'user'             => [
                            'dynamic'    => TRUE,
                            'properties' => [
                                'id'           => ['type' => 'integer'],
                                'email'        => ['type' => 'string', 'include_in_all' => TRUE],
                                'first_name'   => ['type' => 'string', 'include_in_all' => TRUE],
                                'last_name'    => ['type' => 'string', 'include_in_all' => TRUE],
                                'display_name' => ['type' => 'string', 'include_in_all' => TRUE],
                                'phone'        => ['type' => 'string'],
                                'image'        => ['type' => 'string'],
                                'directory'    => ['type' => 'string'],
                            ]
                        ],
                        'ratings'          => [
                            'dynamic'    => TRUE,
                            'properties' => [
                                'user_id' => ['type' => 'integer'],
                                'stars'   => ['type' => 'integer', 'include_in_all' => TRUE],
                                'comment' => ['type' => 'string', 'include_in_all' => TRUE]
                            ]
                        ],
                        'futuresessions'   => [
                            'dynamic'    => TRUE,
                            'properties' => [
                                'id'        => ['type' => 'integer'],
                                'members'   => ['type' => 'integer'],
                                'price'     => ['type' => 'double'],
                                'duration'  => ['type' => 'integer'],
                                'tickets'   => ['type' => 'integer'],
                                'remaining' => ['type' => 'integer'],
                                'date_time' => [
                                    'type'           => 'date',
                                    'format'         => 'yyyy-MM-dd HH:mm:ss',
                                    'include_in_all' => TRUE
                                ],
                                'comment'   => ['type' => 'string', 'include_in_all' => TRUE]
                            ]
                        ],
                    ],
                ];
                break;

            case 'search':
                $mapping = [
                    '_source'    => ['enabled' => TRUE],
                    'properties' => [

                        '_all'     => ['enabled' => TRUE],
                        'id'       => [
                            'type'           => 'string',
                            'index'          => 'not_analyzed',
                            'include_in_all' => FALSE
                        ],
                        'search'   => ['type' => 'string', 'include_in_all' => TRUE],
                        'size'     => ['type' => 'string', 'include_in_all' => TRUE],
                        'radius'   => ['type' => 'string', 'include_in_all' => TRUE],
                        'search'   => ['type' => 'string', 'include_in_all' => TRUE],
                        'url'      => ['type' => 'string', 'include_in_all' => TRUE],
                        'url_type' => ['type' => 'string', 'include_in_all' => TRUE],
                        'user_ip'  => ['type' => 'string', 'include_in_all' => TRUE],
                        'user_id'  => ['type' => 'string', 'include_in_all' => TRUE],
                        'name'     => ['type' => 'string', 'include_in_all' => TRUE],
                        'lat'      => ['type' => 'string', 'include_in_all' => TRUE],
                        'lng'      => ['type' => 'string', 'include_in_all' => TRUE],
                        'results'  => ['type' => 'integer'],
                        'date'     => ['type' => 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],


                    ],
                ];
                break;
        }


        if (count($mapping) > 0) {

            $params['body'] = $mapping;

            return $this->elasticsearch->indices()->putMapping($params);
        } else {
            return FALSE;
        }
    }


    /**
     * @param bool $index
     * @return bool
     */
    public function deleteIndex($index = FALSE)
    {
        $params['index'] = ($index ?: $this->elastic_index);
        try {
            $this->elasticsearch->indices()->delete($params);
        } catch (Exception $e) {
            // There is no Index.. so we dont really care!
        }

        return TRUE;
    }


    /**
     * @param bool $index
     * @return bool
     */
    public function createIndex($index = FALSE)
    {

        $params['index'] = ($index ?: $this->elastic_index);

        try {
            $this->elasticsearch->indices()->create($params);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        return TRUE;
    }


    /**
     * Ping ElasticSearch Instance
     * @return bool
     */
    public function ping() {

        return $this->elasticsearch->ping();
    }
}

