<?php


/**
 * Class Evercisegroup
 */
class Search
{

    protected $elastic;
    protected $evercisegroup;
    protected $log;

    public function __construct($elastic, $evercisegroup, $log)
    {
        $this->elastic = $elastic;
        $this->evercisegroup = $evercisegroup;
        $this->log = $log;
    }


    public function getResults(Place $area, $params = [])
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

        return $this->elastic->searchEvercisegroups($area, $params);

    }


}