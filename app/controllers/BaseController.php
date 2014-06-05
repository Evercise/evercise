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
	  	 $this->user=  Sentry::getUser();
	  }


	protected function setupLayout()
	{
		$displayName = "none";
		$userId = 0;
		$displayImage = url('/')."/img/no-user-img.jpg"; // TODO - default image
		$user = '';


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

	public function randomPassword() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	public function arrayDate($array, $format='h:ia M-dS')
	{
		$dateTime = array();

		foreach ($array as $key => $value) {
			$dateTime[$key] = date($format, strtotime($value));
		}
		return $dateTime;
	}


}