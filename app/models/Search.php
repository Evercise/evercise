<?php


/**
 * Class Evercisegroup
 */
class Search
{

    /**
     * @var
     */
    protected $elastic;
    /**
     * @var
     */
    protected $evercisegroup;
    /**
     * @var
     */
    protected $log;

    /**
     * @param $elastic
     * @param $evercisegroup
     * @param $log
     */
    public function __construct($elastic, $evercisegroup, $log)
    {
        $this->elastic = $elastic;
        $this->evercisegroup = $evercisegroup;
        $this->log = $log;
    }


    /**
     * Get results for a specific Place
     * @param Place $area
     * @param array $params
     * @param bool $all
     * @return mixed
     */
    public function getResults(Place $area, $params = [], $all = false)
    {
        /**  Set Defaults */
        $defaults = [
            'radius' => '1mi',
            'size'   => 24,
            'from'   => 0
        ];

        foreach ($defaults as $key => $val) {
            if (!isset($params[$key])) {
                $params[$key] = $val;
            }
        }

        $results = $this->elastic->searchEvercisegroups($area, $params);

        return $this->formatResults($results);

    }


    /**
     * Get a single Result from Elastic
     * @param int $id
     * @return mixed
     */
    public function getSingle($id = 0) {

        $results = $this->elastic->getSingle($id);

        return $this->formatResults($results);
    }


    /**
     * Format Results
     * @param $results
     * @return mixed
     */
    public function formatResults($results)
    {
        $all_results = [];

        foreach ($results->hits as $r) {
            $all_results[] = $this->formatSingle($r->_source);
        }

        $results->hits = $all_results;

        return $results;
    }

    /**
     * Format a single Result
     * @param $row
     * @return mixed
     */
    public function formatSingle($row)
    {
        /** Add Lat and Lon to the venue */
        if (!empty($row->venue->location->geohash)) {
            try {
                $decoded = $this->elastic->decodeLocationHash($row->venue->location->geohash);

                $row->venue->lat = $decoded['latitude'];
                $row->venue->lng = $decoded['longtitude'];

            } catch (Exception $e) {

                /** We don't have a location for this guys.. lets just skip */
                $this->log->error('Missing LOCATION for ' . $row->id);
                $row->venue->lat = '';
                $row->venue->lng = '';
            }
        }

        return $row;
    }


    /**
     * Clean the results for the MAP
     * @param $results
     * @return array
     */
    public function cleanMapResults($results)
    {


        $mapResult = [];

        $not_needed = [
            'global'  => [
                'default_duration',
                'published',
                'created_at',
                'updated_at',
                'venue_id',
                'title',
                'gender'
            ],
            'user' => ['id' , 'display_name' , 'first_name', 'last_name', 'email', 'image', 'phone'],
            'venue'   => ['id', 'address', 'postcode', 'location', 'image'],
            'ratings' => ['user_id', 'comment']
        ];
        foreach ($results->hits as $k => $row) {

            /** UNSET everything else that we don't need! */

            foreach ($not_needed['global'] as $n) {
                if (isset($row->{$n})) {
                    unset($row->{$n});
                }
            }

            foreach ($not_needed['user'] as $n) {
                if (isset($row->user->{$n})) {
                    unset($row->user->{$n});
                }
            }

            foreach ($not_needed['venue'] as $n) {
                if (isset($row->venue->{$n})) {
                    unset($row->venue->{$n});
                }
            }


            foreach ($not_needed['ratings'] as $n) {
                if (isset($row->ratings->{$n})) {
                    unset($row->ratings->{$n});
                }
            }

            $mapResult[] = $row;
        }

        return $mapResult;

    }


    /**
     * Clean a Single Results
     * @param $results
     * @return array
     */
    public function cleanSingleResults($results)
    {


        $mapResult = [];

        $not_needed = [
            'global'  => [
                'created_at',
                'updated_at',
                'venue_id',
            ],
            'venue'   => ['id', 'address', 'postcode', 'location', 'image'],
            'ratings' => ['user_id']
        ];
        foreach ($results->hits as $row) {

            /** UNSET everything else that we don't need! */

            foreach ($not_needed['global'] as $n) {
                if (isset($row->{$n})) {
                    unset($row->{$n});
                }
            }

            foreach ($not_needed['venue'] as $n) {
                if (isset($row->venue->{$n})) {
                    unset($row->venue->{$n});
                }
            }


            foreach ($not_needed['ratings'] as $n) {
                if (isset($row->ratings->{$n})) {
                    unset($row->ratings->{$n});
                }
            }

            $mapResult[] = $row;
        }

        return $mapResult;

    }



}