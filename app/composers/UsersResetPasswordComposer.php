<?php
 
class UsersResetPasswordComposer {
 
  public function compose($view)
  {


  	JavaScript::put(['initUsers' => 1]); // Initialise Users JS.

  }
}