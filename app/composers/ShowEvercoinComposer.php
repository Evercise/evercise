<?php
 
class ShowEvercoinComposer {

	 public function compose($view)
  	{

      $user = User::where('id', Sentry::getUser()->id)->with('referrals')->with('milestone')->first();
  		
      $evercoin = Evercoin::where('user_id', $user->id)->first();

      $evercoinHistory = Evercoinhistory::where('user_id', $user->id)->get();

      $evercoinBalance = $evercoin->balance;

      $priceInEvercoins = Evercoin::poundsToEvercoins($evercoinBalance);

      $fb = $user->token->facebook ? true : false;
      $tw = $user->token->twitter ? true : false;

      $referrals = $user->referrals;

      $profile = $user->milestone->profile;

      $referralConfig = Config::get('values')['milestones']['referral'];
      $numReferrals = $user->milestone->referrals;
      $totalReferrals = ceil($numReferrals / $referralConfig['count']) * $referralConfig['count'];

      $profile = 60; // 60 + the 4 tests below = 100%
      $profile += $user->gender ? 10 : 0;
      $profile += $user->dob ? 10 : 0;
      $profile += $user->phone ? 10 : 0;
      $profile += $user->image ? 10 : 0;

      $view
        ->with('evercoinBalance', $evercoinBalance)
        ->with('priceInEvercoins', $priceInEvercoins)
	      ->with('evercoinHistory', $evercoinHistory)
	      ->with('fb', $fb)
        ->with('tw', $tw)
        ->with('referrals', $referrals)
        ->with('numReferrals', $numReferrals)
        ->with('totalReferrals', $totalReferrals)
        ->with('profile', $profile)
	      ->with('id', $user->id);
  	}
}