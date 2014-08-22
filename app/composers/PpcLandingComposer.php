<?php
 
class PpcLandingComposer {
 
  public function compose($view)
  {

  	JavaScript::put(
        [
            'initPut'       	  => 	json_encode(['selector' => '#send_ppc'])      
        ]
    );
  }
}