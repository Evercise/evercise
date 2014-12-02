<?php  namespace events;


use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;

class Trainer
{
    protected $config;
    protected $log;
    protected $event;
    protected $activity;
    protected $indexer;
    protected $mail;
    protected $track;

    public function __construct(
        Writer $log,
        Repository $config,
        Dispatcher $event,
        Activity $activity,
        Indexer $indexer,
        Mail $mail,
        Tracking $track
    ) {
        $this->config = $config;
        $this->log = $log;
        $this->event = $event;

        $this->activity = $activity;
        $this->indexer = $indexer;
        $this->mail = $mail;
        $this->track = $track;
    }


    public function sessionJoined($user, $trainer, $session){

    }
}