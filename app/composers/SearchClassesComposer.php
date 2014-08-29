<?php namespace composers;

use JavaScript;

class SearchClassesComposer {
 
  public function compose($view)
  {

  	JavaScript::put(array('InitSearchForm' => 1 )); 

  }
}