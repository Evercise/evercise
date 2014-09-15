<?php namespace composers;

use Input;
use Category;


class RefineComposer
{

    public function compose($view)
    {

        $radiuses = array(
            '1'   => '1 mile',
            '5'   => '5 miles',
            '10'  => '10 miles',
            '15'  => '15 miles',
            '25'  => '25 miles',
            '201' => 'anywhere'
        );
        $selectedRadius = Input::get('radius');
        $types = Category::lists('name', 'id');
        $selectedCategory = Input::get('category');
        $selectedLocation = Input::get('location');

        $types = [null => 'Im looking for...'] + $types;

        $view->with('radiuses', $radiuses)
            ->with('selectedRadius', $selectedRadius)
            ->with('selectedCategory', $selectedCategory)
            ->with('selectedLocation', $selectedLocation)
            ->with('types', $types);
    }
}