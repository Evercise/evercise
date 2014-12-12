<?php namespace cronjobs;


use events\Mail;
use Illuminate\Log\Writer;


class ReminderForPayments
{

    private $log;
    private $mail;

    public function __construct(Writer $log, Mail $mail)
    {

        $this->log = $log;
        $this->mail = $mail;
    }

    function run()
    {
        $this->log->info('Sending Payments Reminder');

        $payments = \Withdrawalrequest::where('processed', 0)->count();

        if($payments > 0) {
            $this->mail->adminSendReminderForPayments($payments);
        }

    }
}