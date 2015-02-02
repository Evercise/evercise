<?php
use Carbon\Carbon;


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


        $this->cart = EverciseCart::getCart();

        $this->cart_items = [];
        foreach ($this->cart['sessions_grouped'] as $key_id => $val) {
            $this->cart_items[$key_id] = $val['qty'];
        }


    }


    /**
     * Get results for a specific Place
     * @param Place $area
     * @param array $params
     * @param bool $all
     * @return mixed
     */
    public function getMapResults(Place $area, $params = [], $all = FALSE)
    {
        /**  Set Defaults */
        $defaults = [
            'radius' => $params['radius'],
            'size'   => $params['size'],
            'from'   => $params['from'],
            'fields' => ['id', 'venue.id', 'venue.name', 'venue.lat', 'venue.lon']
        ];


        foreach ($defaults as $key => $val) {
            if (!isset($params[$key])) {
                $params[$key] = $val;
            }
        }
        $results = $this->elastic->searchEvercisegroups($area, $params);

        return $this->formatMapResults($results, $area);

    }


    /**
     * Get results for a specific Place
     * @param Place $area
     * @param array $params
     * @param bool $all
     * @return mixed
     */
    public function getResults(Place $area, $params = [], $dates = FALSE)
    {
        /**  Set Defaults */
        $defaults = [
            'radius' => $params['radius'],
            'size'   => $params['size'],
            'from'   => $params['from']
        ];

        foreach ($defaults as $key => $val) {
            if (!isset($params[$key])) {
                $params[$key] = $val;
            }
        }
        $results = $this->elastic->searchEvercisegroups($area, $params, $dates);


        if ($dates) {
            return $this->formatDates($results, $area);
        }

        return $this->formatResults($results, $area);

    }


    /**
     * Get a single Result from Elastic
     * @param int $id
     * @return mixed
     */
    public function getSingle($id = 0)
    {

        $results = $this->elastic->getSingle($id);

        return $this->formatResults($results, FALSE);
    }


    /**
     * Format Results
     * @param $results
     * @return mixed
     */
    public function formatResults($results, $area = FALSE)
    {
        $all_results = [];

        foreach ($results->hits as $r) {
            $all_results[] = $this->formatSingle($r, $area);
        }

        $results->hits = $all_results;

        return $results;
    }


    public function formatDates($results)
    {

        $all_dates = [];

        foreach ($results->hits as $r) {
            $fields = (array)$r->fields;
            foreach ($fields['futuresessions.date_time'] as $date) {
                $date = date('Y-m-d', strtotime($date));

                if($date > date('Y-m-d', strtotime('+3 months')) || $date < date('Y-m-d')) {
                    continue;
                }
                if (!isset($all_dates[$date])) {
                    $all_dates[$date] = 0;
                }
                $all_dates[$date]++;
            }
        }
        ksort($all_dates);

        return $all_dates;


    }


    /**
     * Format Results
     * @param $results
     * @return mixed
     */
    public function formatMapResults($results)
    {
        $mapResults = [];

        foreach ($results->hits as $r) {
            $fields = (array)$r->_source;

            $id = $fields['id'];
            $venue_id = $fields['venue_id'];
            $mapResults[$venue_id][$id]['location'] = [$fields['venue']->lon => $fields['venue']->lat];
            $mapResults[$venue_id][$id]['classes'][] = $id;
            $mapResults[$venue_id][$id]['total'] = count($mapResults[$venue_id][$id]['classes']);
        }

        return $mapResults;
    }


    /**
     * Format a single Result
     * @param $row
     * @return mixed
     */
    public function formatSingle($row, $area)
    {


        $i = 0;
        $row->_source->score = $row->_score;

        foreach ($row->_source->futuresessions as $s) {
            $row->_source->futuresessions[$i]->date_time = (new Carbon($s->date_time))->format('M jS, g:ia');

            $i++;
        }

        /** Add Lat and Lon to the venue */
        if (!empty($row->_source->venue->location->geohash) && $area) {
            try {
                $decoded = $this->elastic->decodeLocationHash($row->_source->venue->location->geohash);

                $row->_source->venue->lat = $decoded['latitude'];
                $row->_source->venue->lng = $decoded['longtitude'];


                if (!empty($row->sort[0])) {
                    $row->_source->distance = round($row->sort[0], 2);
                } else {
                    $row->_source->distance = round($this->getDistance($decoded['latitude'], $decoded['longtitude'],
                        $area->lat,
                        $area->lng, 'M'), 2);
                }


            } catch (Exception $e) {
                /** We don't have a location for this guys.. lets just skip */
                $this->log->error('Missing LOCATION for ' . $row->id);
                $row->_source->venue->lat = '';
                $row->_source->venue->lng = '';
                $row->_source->distance = '';
            }
        }

        /** Set Default Amount*/

        $i = 0;
        foreach ($row->_source->futuresessions as $s) {
            if (!empty($this->cart_items[$s->id])) {
                $row->_source->futuresessions[$i]->default_tickets = $this->cart_items[$s->id];
            }
            $i++;
        }

        return $row->_source;
    }


    private function getDistance($lat1 = FALSE, $lon1 = FALSE, $lat2 = FALSE, $lon2 = FALSE, $unit = 'K')
    {
        if (!$lat1 || !$lon1 || !$lat2 || !$lon2) {
            return '';
        }

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else {
            if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }

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
            'user'    => ['id', 'display_name', 'first_name', 'last_name', 'email', 'image', 'phone'],
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

            $futuresessions = [];

            if (count($row->futuresessions) > 4) {
                $total = 0;
                foreach ($row->futuresessions as $s) {

                    if ($total > 3) {
                        $row->futuresessions = $futuresessions;
                        break;
                    }

                    if ($s->remaining > 0) {
                        $futuresessions[] = $s;
                        $total++;
                    }
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