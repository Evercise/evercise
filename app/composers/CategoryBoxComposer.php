<?php
 
class CategoryBoxComposer {

	public function compose($view)
  	{
  		$viewdata = $view->getData();

  		$categoryId = $viewdata['category'];

  		$category = Category::find($categoryId);

  		$view->with('category', $category);
  	}
}