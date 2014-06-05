<?php
 
class UpcomingPastSessions {

	 public function compose($view)
  	{

  		// get view data


		$viewdata= $view->getData();

		// set arrays

		$futureDates = array();
		$pastDates = array();
		$dt = date('Y-m-d H:i:s');

		// loop through view data array with session dates key

		// TODO - order by date, rather than ID

		foreach ($viewdata['sessionDates'] as $key => $value) {
			if (empty($value) ) {
				$futureDates[] = null;
				$pastDates[] = null;
			}else{
				foreach ($value as $k => $val) {
					if (strtotime($val) >= strtotime($dt) ) {
						$futureDates[$key][$k] = $val;
					}else{
						$pastDates[$key][$k] = $val;
					}
					
				}
			}
	   }

	    $key = (isset($viewdata['EGindex'])) ? $viewdata['EGindex'] : $viewdata['key'];
	    //$key = $viewdata['EGindex'] ;
	    $view->with('futureDates', $futureDates)->with('pastDates', $pastDates)->with('key', $key);
	}
}