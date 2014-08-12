<?php
 
class ChangePasswordComposer {
 
  public function compose($view)
  {
	JavaScript::put(array('initChangePassword' => 1 )); // Initialise Users JS.
	JavaScript::put(array('initPut' => json_encode(['selector' => '#password_change']) ));
  }
 
}