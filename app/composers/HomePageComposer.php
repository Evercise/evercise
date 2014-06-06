<?php
 
class HomePageComposer {
 
  public function compose($view)
  {

  	$class = 'no-bk';

  	$radiuses = array('5' => '5 miles', '10' => '10 miles',  '15' => '15 miles', '25' => '25 miles' , '3500' => 'anywhere');
  	$types = Category::lists('name','id');

  	JavaScript::put(array('initPlayVideo' => 1 )); // Initialise Create Trainer JS.

  	$view->with('class', $class)
  		 ->with('radiuses' , $radiuses)
  		 ->with('types' , $types);
  }
}