<?php
 
class UserEditComposer {

	 public function compose($view)
  	{
		$user = Sentry::getUser();

		$firstName = $user->first_name;
		$lastName = $user->last_name;
		$dob = $user->dob != '0000-00-00 00:00:00' ? $user->dob : '';
		$email = $user->email;
		$gender = $user->gender;

    	$markPref = User::find($user->id)->marketingpreferences()->where('name', 'newsletter')->first()['option'];

		JavaScript::put(array('initImage' => 1 )); // Initialise image JS.
		JavaScript::put(array('initUsers' => 1 )); // Initialise Users JS.
		$view->with('firstName', $firstName)
			->with('lastName', $lastName)
			->with('dob', $dob)
			->with('email', $email)
			->with('gender', $gender)
			->with('marketingPreference', $markPref);
	}
}