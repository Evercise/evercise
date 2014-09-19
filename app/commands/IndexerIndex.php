<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class IndexerIndex extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'indexer:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index Elasticgroups';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        /** Load a partial instance of the Elastic thingy... no need for everything to be injected!*/
        $this->elastic = new Elastic(
            Geotools::getFacadeRoot(),
            new Evercisegroup(),
            Es::getFacadeRoot(),
            Log::getFacadeRoot()
        );

        $this->elastic_index = getenv('ELASTIC_INDEX');
        $this->elastic_type = getenv('ELASTIC_TYPE');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

        $time_start = microtime(true);

        if (!$this->elastic_index) {
            $this->error('YOU NEED TO UPDATE YOUR .env.php file.');
            $this->error('Please check EXAMPLE.env.php');
            return;
        }
        $id = $this->option('id');

        $this->info('Indexing All fields from Evercisegroups');
        $total_indexed = $this->elastic->indexEvercisegroups($id);

        $time = microtime(true) - $time_start;

        $this->info('Index a total of ' . $total_indexed . ' evercisegroups in ' . round($time, 2) . ' seconds');

    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('id', null, InputOption::VALUE_OPTIONAL, 'Index Single Evercise Group', 0),
        );
    }


}
