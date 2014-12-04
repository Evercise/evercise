<?php  namespace events;


use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;

class User
{
    protected $config;
    protected $log;
    protected $event;
    protected $activity;
    protected $indexer;
    protected $mail;
    protected $track;

    public function __construct(
        Activity $activity,
        Indexer $indexer,
        Mail $mail,
        Writer $log,
        Repository $config,
        Dispatcher $event,
        Tracking $track
    ) {
        $this->config = $config;
        $this->log = $log;
        $this->event = $event;
        $this->track = $track;

        $this->activity = $activity;
        $this->indexer = $indexer;
        $this->mail = $mail;
    }


    public function hasRegistered($user)
    {
        $this->log->info('User ' . $user->id . ' has registered');

        $this->track->userRegistered($user);
    }

    public function sessionJoined($user, $session)
    {
        $this->log->info('User ' . $user->id . ' joined session ' . $session->id);

        $this->track->registerUserSessionTracking($user, $session);

    }




    public function cartCompleted($user, $cart, $transaction)
    {


        $this->log->info('User ' . $user->id . ' cart completed');

        $this->mail->userCartCompleted($user, $cart, $transaction);

        $this->activity->userCartCompleted($user, $cart, $transaction);

    }

    public function topupCompleted($user, $transaction)
    {


        $this->log->info('User ' . $user->id . ' topup completed');

        //$this->mail->userCartCompleted($user, $transaction);

        $this->activity->userTopupCompleted($user, $transaction);

    }
} 