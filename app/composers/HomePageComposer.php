<?php namespace composers;

use JavaScript;

class HomePageComposer {
 
  public function compose($view)
  {

  	JavaScript::put(
        [
            'initPlayVideo'       	  => 1,
        ]
    );

  }
}