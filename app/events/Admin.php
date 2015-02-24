<?php  namespace events;


use Log;
use Illuminate\Log\Writer;

class Admin
{
    /**
     * @var Writer
     */
    protected $log;
    /**
     * @var Activity
     */
    protected $activity;
    /**
     * @var Mail
     */
    protected $mail;

    /**
     * @param Mail $mail
     */
    public function __construct(
        Writer $log,
        Activity $activity,
        Mail $mail
    ) {
        $this->log = $log;
        $this->activity = $activity;
        $this->mail = $mail;
    }

    public function hasCreatedTrainer($user, $trainer, $password)
    {
        $this->log->info('Admin Created a Trainer with id '.$user->id);

        $this->activity->userRegistered($user);
        $this->activity->trainerRegistered($user);

        $resetCode = $user->getResetPasswordCode();

        $this->mail->adminCreateTrainer($user, $resetCode, $password);



    }
}