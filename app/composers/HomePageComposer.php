<?php
 
class HomePageComposer {
 
  public function compose($view)
  {

  	$class = 'no-bk';

  	JavaScript::put(array('initPlayVideo' => 1 )); // Initialise Create Trainer JS.
  	JavaScript::put(array('InitSearchForm' => 1 )); // Initialise Create Trainer JS.

  	$view->with('class', $class);
  }
}