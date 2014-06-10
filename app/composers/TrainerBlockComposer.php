<?php
 
class TrainerBlockComposer {

	public function compose($view)
  	{
  	  $viewdata = $view->getData();

      $trainer = $viewdata['trainer'];

  		$gender =  $trainer->gender;


  		if ($gender == 0 ) {
  			$gender = 'female';
  		}
  		else
  		{
  			$gender = 'male';
  		}

  		$dob =  $trainer->dob;

  		$from = new DateTime($dob);
  		$to   = new DateTime('today');
  		$age  =  $from->diff($to)->y;

  		$bio =  $trainer->bio;

      $speciality = Speciality::find(4)->pluck(DB::raw("CONCAT(name, ' ', titles)"));

		  JavaScript::put(array('initReadMore' => 1 )); // Initialise read more.

  		$view
        ->with('gender', $gender)
        ->with('age', $age)
        ->with('speciality' , $speciality)
        ->with('bio' , $bio);
  	}
} 