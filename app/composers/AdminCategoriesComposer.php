<?php namespace composers;

use JavaScript;

class AdminCategoriesComposer {

    public function compose($view)
    {
        $categories = \Category::get();

        return $view->with('categories', $categories);
    }
}