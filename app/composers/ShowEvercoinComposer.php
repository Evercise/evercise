<?php
 
class ShowEvercoinComposer {

	 public function compose($view)
  	{

      $id = Sentry::getUser()->id;
  		
      $evercoin = Evercoin::where('user_id', $id)->first();

      $evercoin_balance = $evercoin->balance;


      $view ->with('evercoin_balance', $evercoin_balance);
  	}
}