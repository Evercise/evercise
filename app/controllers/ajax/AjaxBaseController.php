<?php namespace ajax;

use Controller, Sentry, View;

class AjaxBaseController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */


    public function __construct()
    {
        $this->beforeFilter('csrf');
    }
}