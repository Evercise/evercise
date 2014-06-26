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

	public function poundsToEvercoins($amountInPounds)
	{
		return $amountInPounds * 100;
	}
	public function evercoinsToPounds($amountInEvercoins)
	{
		return $amountInEvercoins * 0.01;
	}


}