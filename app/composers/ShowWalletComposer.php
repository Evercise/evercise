<?php
 
class ShowWalletComposer {

	 public function compose($view)
  	{

      $id = Sentry::getUser()->id;
  		
      $wallet = Wallet::where('user_id', $id)->first();

      $balance = $wallet->balance;

      $view->with('balance', $balance);
  	}
}