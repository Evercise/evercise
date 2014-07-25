<?php
 
class AutocompleteCategoryComposer {
 
  public function compose($view)
  {
  	$subcategories = Subcategory::lists('name');
  	sort($subcategories);

    JavaScript::put(array('initAutocompleteCategory' => ['force'=>1, 'list'=>$subcategories]));

  }
 
}