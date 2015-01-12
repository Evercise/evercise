<?php

/**
 * Class PingElastic
 */
class PingElastic
{


    /**
     * @var Evercisegroup
     */
    protected $evercisegroup;
    /**
     * @var \Illuminate\Log\Writer
     */
    protected $log;
    /**
     * @var Elastic
     */
    protected $elastic;
    /**
     * @var
     */
    protected $search;

    /**
     * @param Evercisegroup $evercisegroup
     * @param \Illuminate\Log\Writer $log
     * @param Es $elasticsearch
     * @param Geotools $geotools
     */
    public function __construct(
        Evercisegroup $evercisegroup,
        Illuminate\Log\Writer $log,
        Es $elasticsearch,
        Geotools $geotools
    ) {

        $this->evercisegroup = $evercisegroup;
        $this->log = $log;

        $this->elastic = new Elastic(
            $geotools::getFacadeRoot(),
            $this->evercisegroup,
            $elasticsearch::getFacadeRoot(),
            $this->log
        );

    }




    /**
     * Ping ElasticSearch Instance
     * @return bool
     */
    public function check()
    {

        return $this->elastic->ping();

    }


}