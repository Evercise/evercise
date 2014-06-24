<?php
 
class UserEditComposer {

	 public function compose($view)
  	{
  		$viewdata = $view->getData(); //  grab all view data including shared 

		$user = $viewdata['user'];

		$firstName = $user->first_name;
		$lastName = $user->last_name;
		$dob = $user->dob != '0000-00-00 00:00:00' ? $user->dob : '';
		$email = $user->email;
		$gender = $user->gender;

    	$markPref = User::find($user->id)->marketingpreferences()->where('name', 'newsletter')->first()['option'];

		//JavaScript::put(array('initLeaveSession' => 1 )); 
		JavaScript::put(array('initImage' => json_encode(['ratio' => 'user_ratio']) )); // Initialise Users JS with Ratio string (defined in image.js)
		$view->with('firstName', $firstName)
			->with('lastName', $lastName)
			->with('dob', $dob)
			->with('email', $email)
			->with('gender', $gender)
			->with('marketingPreference', $markPref);
	}
}