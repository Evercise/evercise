<?php
 
 // http://packalyst.com/packages/package/gloudemans/calendar

class CalendarComposer {
 
  public function compose($view)
  {
	if (isset($view->month)){
		$month = $view->month;
		$year = $view->year;
	}
	else{
		$month = date('m');
		$year = date('Y');
	}
	
	$calendarData = array();
	$startDay = $month == date('m') ? date('d') : 1;

	if ($month >= date('m') && $year >= date('Y'))
		for ($i=$startDay; $i<=date("t"); $i++)
			$calendarData[$i] = 'day_'.$i;
	

	$template = Functions::getCalendarTemplate();

	JavaScript::put(array('initEverciseGroups' => 1 ));
	JavaScript::put(array('price' => json_encode(array('min'=>0, 'max'=>99, 'step'=>0.50, 'value'=>1))));

	Calendar::initialize(array('template' => $template, 'show_next_prev' => true));

	$view->with('calendarData', $calendarData);
  }
 
}