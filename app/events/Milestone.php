<?php  namespace events;

use Illuminate\Config\Repository;
use Illuminate\Log\Writer;

/**
 * Class Milestone
 * @package events
 */
class Milestone
{
    /**
     * @var Dispatcher
     */
    private $config;
    /**
     * @var Writer
     */
    private $log;
    /**
     * @var Activity
     */
    private $activity;

    /**
     * @param Writer $log
     * @param Repository $config
     * @param Activity $activity
     */
    public function __construct(
        Writer $log,
        Repository $config,
        Activity $activity
    ) {
        $this->config = $config;
        $this->log = $log;
        $this->activity = $activity;
    }


    public function completed($user, $type, $title, $description)
    {
        $this->activity->milestoneCompleted($user, $type, $title, $description);
    }


}


