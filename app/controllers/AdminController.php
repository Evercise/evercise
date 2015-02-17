<?php


/**
 * Class AdminController
 */
class AdminController extends Controller {

    public $user;
    public $data;

    public function __construct() {

        $this->beforeFilter('csrf', array('on' => 'post'));

        $this->user = Sentry::getUser();

        $this->data = [
            'user' => $this->user
        ];
    }

}
