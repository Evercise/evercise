<?php

use Illuminate\View\Factory as View;
class PackagesController extends  \BaseController {

    /**
     * @var Packages
     */
    private $packages;
    /**
     * @var View
     */
    private $view;

    public function __construct(Packages $packages, View $view) {

        $this->packages = $packages;
        $this->view = $view;
    }


    public function index()
    {

        $packages = $this->packages->where('active', 1)->get();

        return $this->view->make('v3.packages.index', compact('packages'))->render();
    }

}