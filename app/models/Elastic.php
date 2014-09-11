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

        /** What Are we Searching For */
        if ($area->coordinate_type == 'polygon' && !empty($area->poly_coordinates) && ($params['radius'] == 'area')) {

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
                $searchParams['body']['query']['filtered']['filter']['geo_polygon']['venue.location']['points'] = $location_points;
            } else {

                $this->log->error('Area ' . $area->id . ' is set to be Polygon but has 0 valid datapoints');
            }

        } else {
            if (!empty($area->lat) && !empty($area->lng)) {
                $searchParams['body']['query']['filtered']['filter']['geo_distance'] = [
                    'distance'       => $params['radius'],
                    'venue.location' => $this->getLocationHash($area->lat, $area->lng)
                ];
            }
        }

        return $this->elasticsearch->search($searchParams);

    }


    /**
     * @param bool $lat
     * @param bool $lon
     * @throws Exception
     */
    public function getLocationHash($lat = false, $lon = false)
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
     * @return bool
     */
    public function indexEvercisegroups()
    {

        $all = $this->evercisegroup->with('venue')
            ->with('user')
            ->with('ratings')
            ->with('futuresessions')
            ->get();

        foreach ($all as $a) {
            if (!empty($a->venue->lat) && !empty($a->venue->lng)) {
                $geohash = $this->geotools->coordinate($a->venue->lat . ',' . $a->venue->lng);
                $encoded = $this->geotools->geohash()->encode($geohash);
                $hash = $encoded->getGeohash();
            } else {
                $hash = '';
            }

            $index = [
                'id'               => (int) $a->id,
                'user_id'          => (int) $a->user_id,
                'venue_id'         => (int) $a->venue_id,
                'name'             => $a->name,
                'title'            => $a->title,
                'gender'           => $a->gender,
                'description'      => $a->description,
                'image'            => $a->image,
                'capacity'         => (int) $a->capacity,
                'default_duration' => (int) $a->default_duration,
                'default_price'    => (double) $a->default_price,
                'published'        => $a->published,
                'user'             => [
                    'id'           => (int) $a->user->id,
                    'email'        => $a->user->email,
                    'first_name'   => $a->user->first_name,
                    'last_name'    => $a->user->last_name,
                    'display_name' => $a->user->display_name,
                    'image'        => $a->user->directory . '/' . $a->user->image,
                    'phone'        => $a->user->phone,
                ],
                'venue'            => [
                    'id'       => (int) $a->venue->id,
                    'name'     => $a->venue->name,
                    'address'  => $a->venue->address,
                    'postcode' => $a->venue->postcode,
                    'location' => [
                        'geohash' => $hash
                    ],
                    'image'    => $a->venue->image
                ],
                'ratings'          => [],
                'futuresessions'   => []
            ];

            foreach ($a->ratings as $s) {

                $index['ratings'][] = [
                    'user_id' => (int) $s->user_id,
                    'stars'   => (int) $s->stars,
                    'comment' => $s->comment
                ];

            }
            foreach ($a->futuresessions as $s) {
                $index['futuresessions'][] = [
                    'members'         => (int) $s->members,
                    'date_time'       => $s->date_time,
                    'price'           => (double) $s->price,
                    'duration'        => (int) $s->duration,
                    'members_emailed' => (int) $s->members_emailed
                ];

            }

            $params = array();
            $params['body'] = $index;

            $params['index'] = $this->elastic_index;
            $params['type'] = $this->elastic_type;
            $params['id'] = $a->id;

            $this->elasticsearch->index($params);
        }

        return true;


    }

    /**
     * @param string $index
     * @param string $type
     * @return array|bool
     */
    public function resetIndex($index = false, $type = false)
    {

        $mapping = [];

        $params['index'] = ($index ?:  $this->elastic_index);
        $params['type'] =($type ?:  $this->elastic_type);

        switch ($type) {
            case 'evercise':
                $mapping = [
                    '_source'    => ['enabled' => true],
                    'properties' => [

                        '_all'             => ['enabled' => true],
                        'id'               => [
                            'type'           => 'string',
                            'index'          => 'not_analyzed',
                            'include_in_all' => false
                        ],
                        'slug'             => ['type' => 'string', 'include_in_all' => false],
                        'name'             => ['type' => 'string', 'index' => 'analyzed', 'include_in_all' => true],
                        'title'            => ['type' => 'string', 'index' => 'analyzed', 'include_in_all' => true],
                        'venue_id'         => ['type' => 'integer', 'include_in_all' => true],
                        'user_id'          => ['type' => 'integer', 'include_in_all' => true],
                        'gender'           => ['type' => 'integer'],
                        'default_price'    => ['type' => 'integer'],
                        'capacity'         => ['type' => 'integer'],
                        'default_duration' => ['type' => 'integer'],
                        'published'        => ['type' => 'integer'],
                        'description'      => ['type' => 'string', 'index' => 'analyzed', 'include_in_all' => true],
                        'image'            => ['type' => 'string'],
                        'venue'            => [
                            'dynamic'    => true,
                            'properties' => [
                                'id'       => ['type' => 'integer'],
                                'name'     => ['type' => 'string', 'include_in_all' => true],
                                'address'  => ['type' => 'string', 'include_in_all' => true],
                                'postcode' => ['type' => 'string', 'include_in_all' => true],
                                'location' => [
                                    'type'      => 'geo_point',
                                    'geohash'   => true,
                                    'lat_lon'   => true,
                                    'fielddata' => [
                                        'format' => 'compressed'
                                    ]
                                ]
                            ]
                        ],
                        'user'             => [
                            'dynamic'    => true,
                            'properties' => [
                                'id'           => ['type' => 'integer'],
                                'email'        => ['type' => 'string', 'include_in_all' => true],
                                'first_name'   => ['type' => 'string', 'include_in_all' => true],
                                'last_name'    => ['type' => 'string', 'include_in_all' => true],
                                'display_name' => ['type' => 'string', 'include_in_all' => true],
                                'phone'        => ['type' => 'string'],
                                'image'        => ['type' => 'string'],
                            ]
                        ],
                        'ratings'          => [
                            'dynamic'    => true,
                            'properties' => [
                                'user_id' => ['type' => 'integer'],
                                'stars'   => ['type' => 'integer', 'include_in_all' => true],
                                'comment' => ['type' => 'string', 'include_in_all' => true]
                            ]
                        ],
                        'futuresessions'   => [
                            'dynamic'    => true,
                            'properties' => [
                                'members'   => ['type' => 'integer'],
                                'price'     => ['type' => 'double'],
                                'duration'  => ['type' => 'integer'],
                                'date_time' => [
                                    'type'           => 'date',
                                    'format'         => 'yyyy-MM-dd HH:mm:ss',
                                    'include_in_all' => true
                                ],
                                'comment'   => ['type' => 'string', 'include_in_all' => true]
                            ]
                        ],
                    ],
                ];
                break;
        }

        if (count($mapping) > 0) {

            $params['body'] = $mapping;
            return $this->elasticsearch->indices()->putMapping($params);
        } else {
            return false;
        }
    }
}

