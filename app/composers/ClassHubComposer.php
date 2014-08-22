<?php
 
class ClassHubComposer {
 
  public function compose($view)
  {

  	JavaScript::put(
        [
            'initPut'       	  => 	json_encode(['selector' => '#newsession']),
            'calendarSlide'       => 	1,            
            'initEvercisegroups'       => 	1,            
        ]
    );


  	$view;
  }
}