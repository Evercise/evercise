<?php namespace ajax;

use Input, Sentry;


class CategoryController extends AjaxBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->user = Sentry::getUser();
    }

    public function getCategories()
    {
        $categories = \Category::with('subcategories')->get();

        return $categories;
        //return var_dump($categories[0]->subcategories[0]);
    }
}