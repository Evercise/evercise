<?php
 
class TimeComposer {
 
  public function compose($view)
  {
    $hours = array();
    for ($i=0; $i<24; $i++)
    {
        $hours[$i] = $i;
    }

    $minute_intervals = 15;
    $minutes = array();
    for ($i=0; $i<60; $i+=$minute_intervals)
    {
        $minutes[$i] = $i;
    }

    $view->with('hours', $hours)->with('minutes', $minutes);
  }
 
}