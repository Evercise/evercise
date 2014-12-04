<?php  namespace events;


use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;

/**
 * Class User
 * @package events
 */
class User
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
     * @param Activity $activity
     * @param Indexer $indexer
     * @param Mail $mail
     * @param Writer $log
     * @param Repository $config
     * @param Dispatcher $event
     * @param Tracking $track
     */
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

    /**
     * @param $user
     */
    public function login($user)
    {

        $this->log->info('User ' . $user->id . ' has Logged In');
        $this->track->userLogin($user);

    }

    /**
     * @param $user
     */
    public function facebookLogin($user)
    {

        $this->log->info('User ' . $user->id . ' has Logged In with Facebook');
        $this->track->userFacebookLogin($user);

    }

    /**
     * @param $user
     */
    public function logout($user)
    {

        $this->log->info('User ' . $user->id . ' has Logged Out');
        $this->track->userLogout($user);

    }

    /**
     * @param $user
     */
    public function edit($user)
    {

        $this->log->info('User ' . $user->id . ' has edited his account');
        $this->track->userEdit($user);
    }


    /**
     * @param $user
     */
    public function hasRegistered($user)
    {
        $this->log->info('User ' . $user->id . ' has registered');

        $this->track->userRegistered($user);
    }

    /**
     * @param $user
     */
    public function facebookRegistered($user)
    {


        $this->log->info('User ' . $user->id . ' has registered with Facebook');
        $this->track->userFacebookRegistered($user);
    }

    /**
     * @param $user
     * @param $session
     */
    public function sessionJoined($user, $session)
    {
        $this->log->info('User ' . $user->id . ' joined session ' . $session->id);

        $this->track->registerUserSessionTracking($user, $session);

    }


    /**
     * @param $user
     * @param $cart
     * @param $transaction
     */
    public function cartCompleted($user, $cart, $transaction)
    {


        $this->log->info('User ' . $user->id . ' cart completed');

        $this->mail->userCartCompleted($user, $cart, $transaction);

        $this->activity->userCartCompleted($user, $cart, $transaction);

    }

    /**
     * @param $user
     * @param $transaction
     */
    public function topupCompleted($user, $transaction)
    {


        $this->log->info('User ' . $user->id . ' topup completed');

        //$this->mail->userCartCompleted($user, $transaction);

        $this->activity->userTopupCompleted($user, $transaction);

    }
} 