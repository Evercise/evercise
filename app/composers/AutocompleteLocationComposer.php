<?php namespace composers;

use JavaScript;

class AutocompleteLocationComposer {
 
  public function compose($view)
  {

    JavaScript::put(array('initAutocompleteLocation' => 1)  );

  }
 
}