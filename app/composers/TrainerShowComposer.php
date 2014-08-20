<?php
 
class TrainerShowComposer {
 
  public function compose($view)
  {

    JavaScript::put(array('mailAll' => 1 ));
              JavaScript::put(array('initSessionListDropdown' => 1 )); // Initialise session list dropdown JS.
              JavaScript::put(array('initEvercisegroupsShow' => 1 )); // Initialise buttons

  	JavaScript::put(
        [
            'mailAll'                       =>   1,              
            'initSessionListDropdown'       =>   1,              
            'initEvercisegroupsShow'        => 	 1           
        ]
    );


  	$view;
  }
}