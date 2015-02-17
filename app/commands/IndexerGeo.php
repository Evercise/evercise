<?php

use Illuminate\Console\Command;

class IndexerGeo extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'indexer:geo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix Issues with Geo location finding crap';

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

        $time_start =  microtime(true);
        $places = Place::where('lat', '<', 50)->get();
        foreach ($places as $p) {
            $geo = Place::getGeo($p->name, true, true);
            $p->lat = $geo['lat'];
            $p->lng = $geo['lng'];
            $p->save();
        }


        $places = Place::where('lat', '>', 55)->get();
        foreach ($places as $p) {
            $geo = Place::getGeo($p->name, true, true);
            $p->lat = $geo['lat'];
            $p->lng = $geo['lng'];
            $p->save();
        }


        $this->info('Geo fix Completed Completed');
        $time = microtime(true) - $time_start;

        $this->info('Index a total of ' . round($time, 2) . ' seconds');

    }


}
