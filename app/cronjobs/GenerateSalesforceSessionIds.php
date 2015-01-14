<?php namespace cronjobs;


use events\Tracking;
use Evercisesession;
use Illuminate\Log\Writer;


class GenerateSalesforceSessionIds
{

    private $log;
    private $tracking;
    private $evercisesession;

    public function __construct(Writer $log, Tracking $tracking, Evercisesession $evercisesession)
    {
        $this->log = $log;
        $this->tracking = $tracking;
        $this->evercisesession = $evercisesession;
    }

    function run()
    {
        $this->log->info('Running Daily Indexer');

        $sessions = $this->evercisesession->where('salesforce_id', '')->limit(30)->get();

        foreach($sessions as $session) {
            $session = $this->tracking->registerSessionTracking($session);

            $this->log->info('Session Created '.$session->salesforce_id);
        }

        $this->log->info('Completed '.$sessions->count());

    }
}