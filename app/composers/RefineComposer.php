<?php
 
class RefineComposer {
 
  public function compose($view)
  {

  	$radiuses = array('5' => '5 miles', '10' => '10 miles',  '15' => '15 miles', '25' => '25 miles' , '3500' => 'anywhere');
  	$types = Category::lists('name','id');

  	$view->with('radiuses' , $radiuses)
  		   ->with('types' , $types);
  }
}