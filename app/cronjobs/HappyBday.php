<?php namespace cronjobs;


use Illuminate\Log\Writer;


class HappyBday
{

    private $log;

    public function __construct(Writer $log)
    {

        $this->log = $log;
    }

    function run()
    {
        $this->log->info(' Happy Bday has Run!');

    }
}