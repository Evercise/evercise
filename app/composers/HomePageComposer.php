<?php
 
class HomePageComposer {
 
  public function compose($view)
  {

  	JavaScript::put(array('initPlayVideo' => 1 )); // Initialise Create Trainer JS.
  	JavaScript::put(array('initClassBlock' => 1 )); // Initialise class block.

  	$view;
  }
}