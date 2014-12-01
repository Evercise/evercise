<?php  namespace events;


use App;
use Log;

class Classes
{

    protected $activity;
    protected $indexer;

    public function __construct() {

        $this->activity = App::make('events\Activity');
        $this->indexer = App::make('events\Indexer');
    }
    public function classCreated($class, $user){

        Log::info('User '.$user->id.' created class '.$class->name);



        /** Mail And other shit Go here */

        $this->activity->createdClass($class, $user);

        $this->indexer->indexSingle($class->id);

    }

}