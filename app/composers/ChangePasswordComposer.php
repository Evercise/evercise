<?php
 
class ChangePasswordComposer {
 
  public function compose($view)
  {
	JavaScript::put(array('initChangePassword' => 1 )); // Initialise Users JS.
  }
 
}