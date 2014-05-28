<?php
 
class TrainerBlockComposer {

	public function compose($view)
  	{
  		$viewdata = $view->getData();

  		$name = $viewdata['trainer']['display_name'];

  		$title = $viewdata['speciality'];

  		$gender = $viewdata['trainer']['gender'];

  		$image = '/profiles/'. $viewdata['trainer']['directory'].'/'.$viewdata['trainer']['image'];

  		if ($gender == 0 ) {
  			$gender = 'female';
  		}
  		else
  		{
  			$gender = 'male';
  		}

  		$dob = $viewdata['trainer']['dob'];

  		$from = new DateTime($dob);
		$to   = new DateTime('today');
		$age  =  $from->diff($to)->y;

		$member_since = date('dS M-Y', strtotime($viewdata['trainer']['created_at']));

		$bio = $viewdata['trainer']['trainer'][0]['bio'];

		JavaScript::put(array('initReadMore' => 1 )); // Initialise read more.

  		$view->with('name', $name)->with('title', $title)->with('image', $image)->with('gender', $gender)->with('age', $age)->with('member_since' , $member_since)->with('bio' , $bio);
  	}
} 