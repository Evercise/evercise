<?php
 
class ShowEvercoinComposer {

	 public function compose($view)
  	{

      $id = Sentry::getUser()->id;
  		
      $evercoin = Evercoin::where('user_id', $id)->first();

      $evercoinBalance = $evercoin->balance;

      //$evercoinbalanceInPounds = poundsToEvercoins($evercoinBalance);

      $view	->with('evercoinBalance', $evercoinBalance);
  	}
}