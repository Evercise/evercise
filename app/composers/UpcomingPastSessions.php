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

		// loop tough view data array with session dates key

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