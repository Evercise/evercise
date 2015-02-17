<?php namespace composers;

use JavaScript;
use User;


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
		$area_code = $user->area_code;
		$phone = $user->phone;


    	$markPref = User::find($user->id)->marketingpreferences()->where('name', 'newsletter')->first()['option'];


        JavaScript::put(
            [
                'initImage'   => 	json_encode(['ratio' => 'user_ratio'])
            ]
        );

		$view->with('firstName', $firstName)
			->with('lastName', $lastName)
			->with('dob', $dob)
			->with('email', $email)
			->with('gender', $gender)
			->with('marketingPreference', $markPref)
			->with('area_code', $area_code)
			->with('phone', $phone);
	}
}