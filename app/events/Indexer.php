<?php  namespace events;


use Log, Geotools,Evercisegroup, Elastic;

class Indexer
{
    protected $elastic;

    public function load()
    {

        if (!isset($this->elastic)) {
            /** Load a partial instance of the Elastic thingy... no need for everything to be injected!*/
            $this->elastic = new Elastic(
                Geotools::getFacadeRoot(),
                new Evercisegroup(),
                \Es::getFacadeRoot(),
                Log::getFacadeRoot()
            );
        }
    }

    public function indexSingle($id)
    {


        $time_start = microtime(true);

        $this->load();


        $total_indexed = $this->elastic->indexEvercisegroups($id);

        $time = microtime(true) - $time_start;



        Log::info('Indexed Classes id '.$id.' in ' . round($time, 2) . ' seconds');

    }


    public function indexAll()
    {

        $time_start = microtime(true);

        $this->load();


        $total_indexed = $this->elastic->indexEvercisegroups();

        $time = microtime(true) - $time_start;

        Log::info('Index a total of ' . $total_indexed . ' Classes in ' . round($time, 2) . ' seconds');
    }
}