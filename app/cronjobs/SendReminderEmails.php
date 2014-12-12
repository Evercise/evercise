<?php namespace cronjobs;


use Illuminate\Log\Writer;


class SendReminderEmails
{

    private $log;
    /**
     * @var \Artisan
     */
    private $artisan;

    public function __construct(Writer $log, \Artisan $artisan)
    {

        $this->log = $log;
        $this->artisan = $artisan;
    }

    function run()
    {
        $this->log->info('Reminder Email Command has Run!');

        $this->artisan->call('emails');

    }
}