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
	  	if (Sentry::check())
	  	{
			$this->user=  Sentry::getUser();
			$userImage =  $this->user->image ? ('profiles/'. $this->user->directory.'/'.$this->user->image) : 'img/no-user-img.jpg' ;
		}
		View::share('userImage', isset($userImage) ? $userImage : '');
	  }


	protected function setupLayout()
	{
		$displayName = "none";
		$userId = 0;
		$user = '';
		$group = '';


		View::share('user', $this->user);
		/*

		View::share('displayName', $this->user->displayName);
		View::share('displayImage', $this->user->image);
		View::share('userId', $this->user->userId);
		View::share('title', 'Evercise');
		*/
		

		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


}