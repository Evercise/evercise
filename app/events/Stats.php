<?php  namespace events;


use Log, Event;

class Stats
{

    public function classViewed($class)
    {
        Log::info('Class Viewed '.$class->id);

        if(!$class instanceof \Evercisegroup) {
            $class = \Evercisegroup::find($class->id);
        }

        $class->increment('counter');

    }
}