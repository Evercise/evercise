<?php  namespace events;


use Log, Event;

class Stats
{

    public function classViewed($class)
    {
        Log::info('Class Viewed '.$class->id);

        $class->increment('counter');

        Event::fire('class.index.single', ['id' => $class->id]);

    }
}