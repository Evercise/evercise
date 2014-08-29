<?php namespace composers;


class TimeComposer
{

    public function compose($view)
    {
        $hours = array();
        for ($i = 0; $i < 24; $i ++) {
            $hours[sprintf("%02s", $i)] = sprintf("%02s", $i);
        }

        $minute_intervals = 15;
        $minutes = array();
        for ($i = 0; $i < 60; $i += $minute_intervals) {
            $minutes[sprintf("%02s", $i)] = sprintf("%02s", $i);
        }
        $hourDefault = (isset($view->hourDefault) ? $view->hourDefault : '12');
        $minuteDefault = (isset($view->minuteDefault) ? $view->minuteDefault : '00');

        $view->with('hours', $hours)->with('minutes', $minutes)->with('hourDefault', $hourDefault)->with(
            'minuteDefault',
            $minuteDefault
        );
    }

}