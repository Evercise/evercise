<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class GenerateUrls extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'classes:url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new hash for the classes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

        $classes = Evercisegroup::all();



        foreach ($classes as $class) {
            $class->slug = str_random(10);
            $class->save();
        }

        $this->line("Completed ".$classes->count());
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            //array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('days', null, InputOption::VALUE_OPTIONAL, 'How many days old records should be before processing.', 3),
        );
    }

}
