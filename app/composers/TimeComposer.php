<?php
 
class TimeComposer {
 
  public function compose($view)
  {
    $hours = array();
    for ($i=0; $i<24; $i++)
    {
        $hours[$i] = sprintf("%02s", $i);
    }

    $minute_intervals = 15;
    $minutes = array();
    for ($i=0; $i<60; $i+=$minute_intervals)
    {
        $minutes[$i] = sprintf("%02s", $i);
    }
    $hourDefault = '12';
    $minuteDefault = '00';

    $view->with('hours', $hours)->with('minutes', $minutes)->with('hourDefault', $hourDefault)->with('minuteDefault', $minuteDefault);
  }
 
}