<?php namespace composers;

use Subcategory;
use JavaScript;


class AutocompleteCategoryComposer {
 
  public function compose($view)
  {
  	$force = isset($view->force) ? $view->force : 0;

  	$subcategories = Subcategory::lists('name');
  	sort($subcategories);

    JavaScript::put(array('initAutocompleteCategory' => ['force'=>$force, 'list'=>$subcategories]));

  }
 
}