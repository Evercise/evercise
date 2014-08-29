<?php namespace composers;

use JavaScript;
use Evercoin;
use Sentry;

class PayWithEvercoinsComposer {

	 public function compose($view)
  	{

  	  $viewdata = $view->getData();

  	  $priceInEvercoins = Evercoin::poundsToEvercoins($viewdata['totalPrice']);
    	
      $user = Sentry::getUser();


      $evercoins = Evercoin::where('user_id', $user->id)->pluck('balance');

      JavaScript::put(array('initPut' => 1 )); // Initialise init put js.

      JavaScript::put(array('initRedeemEvercoin' => json_encode(['balance'=> $evercoins , 'priceInEvercoins' => $priceInEvercoins]) ));

      

  		$view->with('evercoins', $evercoins)
  			 ->with('priceInEvercoins', $priceInEvercoins);
  	}
}