<?php
 
class ShowWalletComposer {

	 public function compose($view)
  	{

      $id = Sentry::getUser()->id;
  		
      $wallet = Wallet::where('user_id', $id)->first();

      // Display balance to 2dp
      $balance = number_format((float)$wallet->balance, 2, '.', '');

      $history = Wallethistory::where('user_id', $id)
      ->orderBy('id', 'asc')
      ->get();

      $view ->with('balance', $balance)
            ->with('history', $history)
            ->with('paypal', $wallet->paypal);
  	}
}