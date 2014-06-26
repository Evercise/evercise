<?php
 
class TrainerBlockComposer {

	public function compose($view)
  	{
  	  $viewdata = $view->getData();

      $userTrainer = $viewdata['trainer']->user;

      $trainerDetails = $viewdata['trainer'];

      $orientation = $viewdata['orientation'];

  		$gender =  $userTrainer->gender;


  		if ($gender == 0 ) {
  			$gender = 'female';
  		}
  		else
  		{
  			$gender = 'male';
  		}

  		$dob =  $userTrainer->dob;

  		$from = new DateTime($dob);
  		$to   = new DateTime('today');
  		$age  =  $from->diff($to)->y;

<<<<<<< HEAD
      $trainerDetails = $viewdata['trainer'];
  		$bio =  $trainerDetails->bio;
      $speciality = Speciality::find($trainerDetails->specialities_id)->pluck(DB::raw("CONCAT(name, ' ', titles)"));
=======

  		$bio =  $trainerDetails->bio;

      //$speciality = Speciality::find($trainerDetails->specialities_id)->pluck(DB::raw("CONCAT(name, ' ', titles)"));
>>>>>>> 8da496fdd7c0f8b0c5c4ddfc8079d48490c109a2

      if ($orientation == 'landscape') {
        JavaScript::put(array('initReadMore' => 1 )); // Initialise read more.
      }
		  

  		$view
        ->with('gender', $gender)
        ->with('age', $age)
        ->with('bio' , $bio);
  	}
} 