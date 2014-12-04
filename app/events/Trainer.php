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
     * @param $user
     * @param $trainer
     * @param $session
     */
    public function sessionJoined($user, $trainer, $session)
    {
        $this->log->info('User ' . $user->id . ' has joined trainer ' . $trainer->id . ' session ' . $session->id);
        $this->mail->userJoinedTrainersSession($user, $trainer, $session);
    }
}