<?php

class PackagesController extends  \BaseController {


    public function index()
    {
        $packages = Packages::where('active', 1)->get();


        $title = 'Fitness Packages | Evercise';
        $desc = 'Get fit and stay active with an Evercise 5 class package and Save up to 30% and enjoy the VIP treatment with one of our 10 class packages.';

        return View::make('v3.packages.index', compact('packages', 'title', 'desc'));
    }

}