<?php  namespace events;


use App;
use Log;

class Classes
{

    protected $activity;
    protected $indexer;
    /**
     * @var Stats
     */
    private $stats;

    public function __construct(Activity $activity, Indexer $indexer, Mail $mail, Stats $stats) {

        $this->activity = $activity;
        $this->indexer = $indexer;
        $this->mail = $mail;
        $this->stats = $stats;
    }



    public function classCreated($class, $trainer){

        Log::info('Trainer '.$trainer->id.' created class '.$trainer->name);



        /** Mail And other shit Go here */

        $this->mail->classCreated($class, $trainer);

        $this->activity->createdClass($class, $trainer);

        $this->indexer->indexSingle($class->id);

    }



    public function classDeleted($class, $user){

        Log::info('User '.$user->id.' Updated class '.$class->name);


        $this->activity->deletedClass($class, $user);

        /** Mail And other shit Go here */
        $this->indexer->indexSingle($class->id);

    }


    public function classUpdated($class, $user){

        Log::info('User '.$user->id.' Updated class '.$class->name);


        $this->activity->updatedClass($class, $user);

        /** Mail And other shit Go here */
        $this->indexer->indexSingle($class->id);

    }


    public function classViewed($class, $user = false){

        $this->stats->classViewed($class);

        $this->indexer->indexSingle($class->id);
    }

}