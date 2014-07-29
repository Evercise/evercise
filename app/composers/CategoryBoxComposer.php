<?php
 
class CategoryBoxComposer {

	public function compose($view)
  	{
  		$viewdata = $view->getData();

  		$subcategories = $viewdata['subcategories'];

  		/*loop through the sub cats to get category pivot */
  		foreach ($subcategories as $key => $subcategory) {
  			$subcats[] = $subcategory->categories;
  		}

  		/*loop though pivot to get catehory */
  		foreach ($subcats as $key => $cat) {
  			foreach ($cat as $key => $cats) {
  				$categories[] = $cats;
  			}
  		}

  		$view->with('categories', $categories);
  	}
}