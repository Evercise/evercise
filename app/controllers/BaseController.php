<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	public $user;

	public function __construct()
	  {

        $this->beforeFilter('csrf', array('on' => 'post'));

	  	if (Sentry::check())
	  	{
			$this->user=  Sentry::getUser();
			$userImage =  $this->user->image ? ('profiles'. '/'.$this->user->directory.'/'.$this->user->image) : 'img'.'/'.'no-user-img.jpg' ;
		}
		View::share('userImage', isset($userImage) ? $userImage : '');
	  }


	protected function setupLayout()
	{

		View::share('user', $this->user);


		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


    /**
     * Check if the user is logged in and redirect if needed
     *
     * @param bool $redirect
     * @return bool
     */
    public function checkLogin() {
        return Sentry::check();
    }


}