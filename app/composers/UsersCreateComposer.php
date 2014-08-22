<?php
 
class UsersCreateComposer {
 
  public function compose($view)
  {


  	JavaScript::put(
  		[
  			'initUsers' 	 => 1, 
  			'initPut'		 => 1, 
  			'initToolTip' 	 => 1
  		]
  	); //Initialise tooltip JS.

  }
}