<?php  namespace events;


use App;
use Illuminate\Log\Writer;

class Classes
{

    protected $activity;
    protected $indexer;
    /**
     * @var Stats
     */
    private $stats;
    private $log;

    public function __construct(Activity $activity, Indexer $indexer, Mail $mail, Stats $stats, Writer $log) {

        $this->activity = $activity;
        $this->indexer = $indexer;
        $this->mail = $mail;
        $this->stats = $stats;
        $this->log = $log;
    }



    public function classCreated($class, $trainer){

        $this->log->info('Trainer '.$trainer->id.' created class '.$trainer->name);



        /** Mail And other shit Go here */

        $this->mail->classCreated($class, $trainer);

        $this->activity->createdClass($class, $trainer);

        $this->indexer->indexSingle($class->id);

    }




    public function classPublished($class, $trainer){

        $this->log->info('Trainer '.$trainer->id.' Published class '.$class->name);

        /** Mail And other shit Go here */
        $this->activity->publishedClass($class, $trainer);

        $this->indexer->indexSingle($class->id);

    }



    public function classUnPublished($class, $trainer){

        $this->log->info('Trainer '.$trainer->id.' UnPublished class '.$class->name);


        $this->activity->unPublishedClass($class, $trainer);

        $this->indexer->indexSingle($class->id);

    }



    public function classDeleted($class, $user){

        $this->log->info('User '.$user->id.' Updated class '.$class->name);


        $this->activity->deletedClass($class, $user);

        /** Mail And other shit Go here */
        $this->indexer->indexSingle($class->id);

    }


    public function classUpdated($class, $user){

        $this->log->info('User '.$user->id.' Updated class '.$class->name);


        $this->activity->updatedClass($class, $user);

        /** Mail And other shit Go here */
        $this->indexer->indexSingle($class->id);

    }


    public function classViewed($class, $user = false){

        $this->stats->classViewed($class);

        $this->indexer->indexSingle($class->id);
    }


    public function venueCreated($venue, $user) {

        $this->log->info('User '.$user->id.' Created Venue '.$venue->name);

        $this->activity->createdVenue($venue,$user);
    }

    public function venueUpdated($venue, $user) {

        $this->log->info('User '.$user->id.' Updated Venue '.$venue->name);

        $this->activity->updatedVenue($venue,$user);
    }

}