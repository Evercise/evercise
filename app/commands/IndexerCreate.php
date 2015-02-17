<?php

use Illuminate\Console\Command;

class IndexerCreate extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'indexer:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the needed Index For Elastic To work';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        /** Load a partial instance of the Elastic thingy... no need for everything to be injected!*/
        $this->elastic = new Elastic([], [], Es::getFacadeRoot(), []);

        $this->elastic_index = getenv('ELASTIC_INDEX');
        $this->elastic_type = getenv('ELASTIC_TYPE');

        return;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

        if(!$this->elastic_index)  {
            $this->error('YOU NEED TO UPDATE YOUR .env.php file.');
            $this->error('Please check Example.env.php');

            return;
        }
        $this->info('Checking if the Index exits. And deleting it!');
        $this->elastic->deleteIndex($this->elastic_index);

        $this->info('Creating a new Index '.$this->elastic_index);
        $this->elastic->createIndex($this->elastic_index);


        $this->info('Setting all the required mappings for the Index');
        $this->elastic->resetIndex($this->elastic_index, $this->elastic_type);


        $this->info('Completed');

    }


}
