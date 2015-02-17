<?php namespace cronjobs;

use Illuminate\Log\Writer;
use Illuminate\Console\Application as Artisan;


class CheckPayments
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
        $this->log->info('Moving all sessions to payments');
        $this->artisan->call('check:payments');

        $this->log->info('Move Money to User Wallet');
        $this->artisan->call('check:sessions');

    }
}

