<?php namespace composers;

use Areacodes;

class AreacodeComposer {
 
  public function compose($view)
  {
  	$areacodes = Areacodes::get();

  	$view->with('areacodes', $areacodes);
  }
}