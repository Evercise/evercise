<?php

class PackagesController extends  \BaseController {


    public function index()
    {
        $packages = Packages::where('active', 1)->get();

        return View::make('v3.packages.index', compact('packages'));
    }

}