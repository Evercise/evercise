<?php namespace composers;

use JavaScript;

class AdminSubcategoriesComposer {

    public function compose($view)
    {
        $subcategories = \Subcategory::with('categories')->get();
        $categories = \Category::lists('name');

        array_unshift($categories, '');

        return $view
            ->with('categories', $categories)
            ->with('subcategories', $subcategories);
    }
}