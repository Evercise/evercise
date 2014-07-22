<?php
 
class AutocompleteComposer {
 
  public function compose($view)
  {

    JavaScript::put(array('initAutocomplete' => 1)  );

  }
 
}