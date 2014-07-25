<?php
 
class AutocompleteLocationComposer {
 
  public function compose($view)
  {

    JavaScript::put(array('initAutocompleteLocation' => 1)  );

  }
 
}