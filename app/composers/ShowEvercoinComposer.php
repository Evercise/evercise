<?php
 
class ShowEvercoinComposer {

	 public function compose($view)
  	{

      $user = User::find(Sentry::getUser()->id);
      $id = $user->id;
  		
      $evercoin = Evercoin::where('user_id', $id)->first();

      $evercoinBalance = $evercoin->balance;

      //$evercoinbalanceInPounds = poundsToEvercoins($evercoinBalance);

      $fb = $user->token->facebook ? true : false;
      $tw = $user->token->twitter ? true : false;

      $view
	      ->with('evercoinBalance', $evercoinBalance)
	      ->with('fb', $fb)
	      ->with('tw', $tw);
  	}
}