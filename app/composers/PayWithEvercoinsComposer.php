<?php
 
class PayWithEvercoinsComposer {

	 public function compose($view)
  	{
    	
      $user = Sentry::getUser();

      $evercoins = Evercoin::where('user_id', $user->id)->pluck('balance');

  		$view->with('evercoins', $evercoins);
  	}
}