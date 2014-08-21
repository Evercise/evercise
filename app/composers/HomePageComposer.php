<?php
 
class HomePageComposer {
 
  public function compose($view)
  {

  	JavaScript::put(
        [
            'initPlayVideo'       	  => 1,
        ]
    );


  	$view;
  }
}