<?php  namespace events;


use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\UrlGenerator;

/**
 * Class Sessions
 * @package events
 */
class Sessions
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
     * @var UrlGenerator
     */
    private $url;

    /**
     * @param Activity $activity
     * @param Indexer $indexer
     * @param Mail $mail
     * @param Writer $log
     * @param Repository $config
     * @param Dispatcher $event
     * @param Tracking $track
     * @param UrlGenerator $url
     */
    public function __construct(
        Activity $activity,
        Indexer $indexer,
        Mail $mail,
        Writer $log,
        Repository $config,
        Dispatcher $event,
        Tracking $track,
        UrlGenerator $url
    ) {
        $this->config = $config;
        $this->log = $log;
        $this->event = $event;
        $this->track = $track;

        $this->activity = $activity;
        $this->indexer = $indexer;
        $this->mail = $mail;
        $this->url = $url;
    }


    /**
     * @param $userList
     * @param $group
     * @param $location
     * @param $dateTime
     * @param $trainerName
     * @param $trainerEmail
     * @param $classId
     */
    public function upcomingSessions($userList, $group, $location, $dateTime, $trainerName, $trainerEmail, $classId, $sessionId){

        $this->log->info('Sending Upcomming Sessions email');
        $this->mail->trainerSessionRemind($userList, $group, $location, $dateTime, $trainerName, $trainerEmail, $classId, $sessionId);

        $this->mail->usersSessionRemind($userList, $group, $location, $dateTime, $trainerName, $trainerEmail, $classId, $sessionId);
    }

    /**
     * @param $userList
     * @param $group
     * @param $session
     * @param $messageSubject
     * @param $messageBody
     */
    public function mailAll($userList, $group, $session, $messageSubject, $messageBody){

        $this->log->info('Trainer Emailing All');
        $this->mail->trainerMailAll($userList, $group, $session, $messageSubject, $messageBody);
    }


    /**
     * @param $trainer
     * @param $user
     * @param $group
     * @param $dateTime
     * @param $messageSubject
     * @param $messageBody
     */
    public function mailTrainer($trainer, $user, $evercisegroup, $session, $subject, $body)
    {

        $this->log->info('User '.$user->id.' Is Emailing Trainer '.$trainer->id);
        $this->mail->mailTrainer($trainer, $user, $evercisegroup, $session, $subject, $body);

    }

    /**
     * @param $user
     * @param $trainer
     * @param $everciseGroup
     * @param $sessionDate
     */
    public function userLeaveSession($user, $trainer, $everciseGroup, $sessionDate){

        $this->log->info('User left Session');

        $this->mail->userLeaveSession($user, $trainer, $everciseGroup, $sessionDate);
        $this->mail->trainerLeaveSession($user, $trainer, $everciseGroup, $sessionDate);

        $this->indexer->indexSingle($everciseGroup->id);
    }

    /**
     * @param $user
     * @param $trainer
     * @param $session
     * @param $everciseGroup
     * @param $transactionId
     */
    public function joinedClass($user, $trainer, $session, $evercisegroup, $transaction) {

        $this->track->registerUserSessionTracking($user, $session);

        $this->mail->trainerJoinSession($user, $trainer, $session, $evercisegroup, $transaction);

        $this->indexer->indexSingle($evercisegroup->id);
    }


    /**
     * @param $email
     * @param $userName
     * @param $userEmail
     * @param $group
     * @param $messageSubject
     * @param $messageBody
     */
    public function refundRequest($email, $userName, $userEmail, $group, $messageSubject, $messageBody) {

        $this->mail->userRequestRefund($email, $userName, $userEmail, $group, $messageSubject, $messageBody);
    }

    /**
     * @param $user
     */
    public function login($user)
    {

        $this->log->info('User ' . $user->id . ' has Logged In');
        $this->track->userLogin($user);

    }

}