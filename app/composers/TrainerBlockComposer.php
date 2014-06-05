<?php
 
class TrainerBlockComposer {

	public function compose($view)
  	{
  	  $viewdata = $view->getData();

      $user = $viewdata['user'];

      $trainer = $viewdata['trainer'];

  		$name = $user->display_name;

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

      $speciality = Speciality::find($trainer->specialities_id)->pluck(DB::raw("CONCAT(name, ' ', titles)"));

		  JavaScript::put(array('initReadMore' => 1 )); // Initialise read more.

  		$view->with('name', $name)
        ->with('image', $image)
        ->with('gender', $gender)
        ->with('age', $age)
        ->with('member_since' , $member_since)
        ->with('speciality' , $speciality)
        ->with('bio' , $bio);
  	}
} 