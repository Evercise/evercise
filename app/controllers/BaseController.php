<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		$displayName = "none";
		try
		{
		    // Get the current active/logged in user
		    $user = Sentry::getUser();
		    if ($user) $displayName = $user->display_name;
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    // User wasn't found, should only happen if the user was deleted
		    // when they were already logged in or had a "remember me" cookie set
		    // and they were deleted.
		}
		View::share('displayName', $displayName);

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


}