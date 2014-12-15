<?php namespace cronjobs;


use Illuminate\Log\Writer;
use Illuminate\Console\Application as Artisan;


class DailyIndexer
{

    private $log;
    private $artisan;

    public function __construct(Writer $log, Artisan $artisan)
    {

        $this->log = $log;
        $this->artisan = $artisan;
    }

    function run()
    {
        $this->log->info('Running Daily Indexer');

        $this->artisan->call('indexer:index');

    }
}