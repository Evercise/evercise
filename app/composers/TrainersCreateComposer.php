<?php
 
class TrainersCreateComposer {
 
  public function compose($view)
  {
  	
  	JavaScript::put(
  		[
  			'initPut'		 => json_encode(['selector' => '#trainer_create']), 
  			'initImage' 	 => json_encode(['ratio' => 'user_ratio']),
  			'initToolTip' 	 => 1
  		]
  	); //Initialise tooltip JS.

  }
}