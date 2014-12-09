<?php  namespace events;


use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;

/**
 * Class Trainer
 * @package events
 */
class Trainer
{
    /**
     * @var Repository
     */
    protected $config;
    /**
     * @var Writer
     */
    protected $log;
    /**
     * @var Dispatcher
     */
    protected $event;
    /**
     * @var Activity
     */
    protected $activity;
    /**
     * @var Indexer
     */
    protected $indexer;
    /**
     * @var Mail
     */
    protected $mail;
    /**
     * @var Tracking
     */
    protected $track;

    /**
     * @param Writer $log
     * @param Repository $config
     * @param Dispatcher $event
     * @param Activity $activity
     * @param Indexer $indexer
     * @param Mail $mail
     * @param Tracking $track
     */
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


    /**
     * @param $trainer
     */
    public function registered($trainer)
    {
        $this->log->info('Trainer ' . $trainer->id . ' has registered');


        $this->mail->trainerRegistered($trainer);
    }


    /**
     * @param $trainer
     */
    public function edit($trainer)
    {
        $this->log->info('Trainer ' . $trainer->id . ' has edited his account');
        $this->track->trainerEdit($trainer);
    }


    /**
     * @param $trainer
     */
    public function whyNotCompleteProfile($trainer)
    {
        $this->log->info('Trainer ' . $trainer->id . ' has been reminded to complete their profile');
        $this->mail->trainerWhyNotCompleteProfile($trainer);
    }
    /**
     * @param $trainer
     */
    public function whyNotCreateFirstClass($trainer)
    {
        $this->log->info('Trainer ' . $trainer->id . ' has been reminded to create their first class');
        $this->mail->trainerWhyNotCreateFirstClass($trainer);
    }

}