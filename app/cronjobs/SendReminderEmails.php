<?php namespace cronjobs;


use Illuminate\Log\Writer;
use Illuminate\Console\Application as Artisan;
use Symfony\Component\Console\Output\BufferedOutput;


class SendReminderEmails
{

    private $log;
    /**
     * @var \Artisan
     */
    private $artisan;

    public function __construct(Writer $log, Artisan $artisan)
    {

        $this->log = $log;
        $this->artisan = $artisan;
    }

    function run()
    {
        $this->log->info('Reminder Email Command has Run!');

        $output = new BufferedOutput;

        $this->artisan->call('email:remind', [], $output);

        return $output->fetch();
    }
}