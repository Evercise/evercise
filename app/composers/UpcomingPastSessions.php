<?php
 
class UpcomingPastSessions {

	 public function compose($view)
  	{
		$viewdata= $view->getData();

		$futureDates = array();
		$pastDates = array();
		$dt = date('Y-m-d H:i:s');

	foreach ($viewdata['sessionDates'] as $key => $value) {
		if (empty($value) ) {
			$futureDates[] = null;
			$pastDates[] = null;
		}else{
			foreach ($value as $k => $val) {
				if (strtotime($val) >= strtotime($dt) ) {
					$futureDates[$key][] = $val;
				}else{
					$pastDates[$key][] = $val;
				}
				
			}
		}
			    
	   }


	    $view->with('futureDates', $futureDates)->with('pastDates', $pastDates);
	}
}