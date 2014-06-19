<?php
 
class TrainerHistoryComposer {

	public function compose($view)
  	{
  		$viewdata = $view->getData();

  		$userTrainer = $viewdata['user'];

  		$historys = Trainerhistory::where('user_id', $userTrainer->id)->orderBy('created_at', 'desc')->get();

  		$view->with('historys',$historys);
  	}
 }