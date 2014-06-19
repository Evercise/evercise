<?php
 
class ShowWalletComposer {

	 public function compose($view)
  	{

      $id = Sentry::getUser()->id;
  		
      $wallet = Wallet::where('user_id', $id)->first();

      $balance = $wallet->balance;

      $history = Wallethistory::where('user_id', $id)->get();

      $view ->with('balance', $balance)
            ->with('history', $history);
  	}
}