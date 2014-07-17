<?php
 
class ShowWalletComposer {

	 public function compose($view)
  	{

      $id = Sentry::getUser()->id;
  		
      $wallet = Wallet::where('user_id', $id)
      ->first();

      // Display balance to 2dp
      $balance = number_format((float)$wallet->balance, 2, '.', '');

      $history = Wallethistory::where('user_id', $id)
      ->orderBy('id', 'asc')
      ->get();

      $earningsThisMonth = (float)0.00;
      $earningsLastMonth = (float)0.00;

      foreach ($history as $key => $record) {
        if ( $record->created_at >= date('Y-m-d H:i:s', strtotime('-1 months'))) {
          if ( $record->transaction_amount > 0)
          {
            $earningsThisMonth += $record->transaction_amount;
          }
        }
        if ($record->created_at >= date('Y-m-d H:i:s', strtotime('-2 months')) && $record->created_at < date('Y-m-d H:i:s', strtotime('-1 months'))) {
          if ( $record->transaction_amount > 0)
          {
            $earningsLastMonth += $record->transaction_amount;
          }
        }
        
      }


      $view ->with('balance', $balance)
            ->with('wallet', $wallet)
            ->with('earningsThisMonth', $earningsThisMonth)
            ->with('earningsLastMonth', $earningsLastMonth)
            ->with('history', $history)
            ->with('paypal', $wallet->paypal);
  	}
}