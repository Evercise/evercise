<?php
 
class TrainerHistoryComposer {

	public function compose($view)
  	{
  		$viewdata = $view->getData();

  		$userTrainer = $viewdata['user'];

  		$historys = Trainerhistory::where('user_id', $userTrainer->id)->get();

  		$view->with('historys',$historys);
  	}
 }