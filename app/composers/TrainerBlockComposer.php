<?php
 
class TrainerBlockComposer {

	public function compose($view)
  	{
  	  $viewdata = $view->getData();

      $user = $viewdata['user'];

      $trainer = $viewdata['trainer'];

  		$name = $user->display_name;

  		$title = $viewdata['speciality'];

  		$gender =  $user->gender;

  		$image = '/profiles/'.  $user->directory.'/'. $user->image;

  		if ($gender == 0 ) {
  			$gender = 'female';
  		}
  		else
  		{
  			$gender = 'male';
  		}

  		$dob =  $user->dob;

  		$from = new DateTime($dob);
		$to   = new DateTime('today');
		$age  =  $from->diff($to)->y;

		$member_since = date('dS M-Y', strtotime( $trainer->created_at));

		$bio =  $trainer->bio;

		JavaScript::put(array('initReadMore' => 1 )); // Initialise read more.

  		$view->with('name', $name)
        ->with('title', $title)
        ->with('image', $image)
        ->with('gender', $gender)
        ->with('age', $age)
        ->with('member_since' , $member_since)
        ->with('bio' , $bio);
  	}
} 