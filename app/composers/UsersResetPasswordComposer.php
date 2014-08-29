<?php namespace composers;

use JavaScript;

class UsersResetPasswordComposer {
 
  public function compose($view)
  {


  	JavaScript::put(
        [
            'initPut' => json_encode(['selector' => '#passwords_reset'])
        ]
    ); // Initialise init put for submission.

  }
}