<?php
 
class DonutChartComposer {

	 public function compose($view)
  	{
  		$rand = rand(1,10000000); // used for muliple instances of the same laracast
  		JavaScript::put(array('initChart_'.$rand => json_encode(array('id' => $view->id  )))); // Initialise chart JS.
  	}
}