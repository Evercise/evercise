<?php
 
 // http://packalyst.com/packages/package/gloudemans/calendar

class CalendarComposer {
 
  public function compose($view)
  {
	$calendarData = array();
	$template = Functions::getCalendarTemplate();

	JavaScript::put(array('initEverciseGroups' => 1 ));
	JavaScript::put(array('price' => json_encode(array('min'=>0, 'max'=>99, 'step'=>0.50, 'value'=>1))));

	Calendar::initialize(array('template' => $template, 'show_next_prev' => true));

	$view->with('calendarData', $calendarData);
  }
 
}