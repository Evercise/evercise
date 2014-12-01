<?php  namespace events;


use App;
use Log;

class Classes
{

    protected $activity;
    protected $indexer;

    public function __construct(Activity $activity, Indexer $indexer, Mail $mail) {

        $this->activity = $activity;
        $this->indexer = $indexer;
        $this->mail = $mail;
    }



    public function classCreated($class, $trainer){

        Log::info('Trainer '.$trainer->id.' created class '.$trainer->name);



        /** Mail And other shit Go here */

        $this->mail->classCreated($class, $trainer);

        $this->activity->createdClass($class, $trainer);

        $this->indexer->indexSingle($class->id);

    }



    public function classDeleted($class, $user){

        Log::info('User '.$user->id.' created class '.$class->name);



        /** Mail And other shit Go here */

        $this->activity->createdClass($class, $user);

        $this->indexer->indexSingle($class->id);

    }

}