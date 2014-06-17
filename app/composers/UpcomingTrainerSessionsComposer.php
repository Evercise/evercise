<?php
 
class UpcomingTrainerSessionsComposer {

	public function compose($view)
  	{
  		$viewdata = $view->getData();

  		$userTrainer = $viewdata['user'];

  		$evercisegroups = Evercisegroup::with('Evercisesession.Sessionmembers.Users')->where('user_id', $userTrainer->id)->get();
  		$view->with('evercisegroups',$evercisegroups);
  	}
 }