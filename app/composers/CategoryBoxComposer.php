<?php namespace composers;

class CategoryBoxComposer
{

    public function compose($view)
    {
        $viewdata = $view->getData();

        $subcategories = $viewdata['subcategories'];

        /*loop through the sub cats to get category pivot */
        foreach ($subcategories as $key => $subcategory) {
            $subcats[] = $subcategory->categories;
        }

        /*loop though pivot to get catehory */
        $categories = [];
        $categoryIds = [];
        foreach ($subcats as $key => $subcat) {
            foreach ($subcat as $key => $cat) {
                if (!in_array($cat->id, $categoryIds)) {
                    $categoryIds[] = $cat->id;
                    $categories[] = $cat;
                }
            }
        }

        $view->with('categories', $categories);
    }
}