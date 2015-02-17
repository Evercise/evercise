<?php

class AdminGalleryController extends AdminController
{


    public function __construct()
    {

        parent::__construct();

    }


    public function index() {

        $this->data['images'] = Gallery::where('counter', '>', 0)->get();


        $this->data['categories'] = [];

        foreach(Category::all() as $c) {
            $this->data['categories'][] = $c->name;
        }
        foreach(Subcategory::all() as $c) {
            $this->data['categories'][] = $c->name;
        }

        $this->data['categories'] = array_unique($this->data['categories']);


        return View::make('admin.gallery', $this->data)->render();
    }
}
