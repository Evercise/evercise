<?php namespace composers;

use Sentry;


class GroupSetComposer {
 
  public function compose($view)
  {
  	$trainerGroup = Sentry::findGroupByName('trainer');
  	$adminGroup = Sentry::findGroupByName('admin');

	

  	$view->with('adminGroup', $adminGroup)
  		->with('trainerGroup', $trainerGroup);
  			 
  }
}