<?php
 
class ShowEvercoinComposer {

	 public function compose($view)
  	{

      $user = User::where('id', Sentry::getUser()->id)->with('referrals')->with('milestone')->first();
  		
      $evercoin = Evercoin::where('user_id', $user->id)->first();

      $evercoinBalance = $evercoin->balance;

      $fb = $user->token->facebook ? true : false;
      $tw = $user->token->twitter ? true : false;

      $referrals = $user->referrals;

      $profile = $user->milestone->profile;

      $referralConfig = Config::get('milestones')['milestones']['referral'];
      $numReferrals = $user->milestone->referrals;
      $totalReferrals = ceil($numReferrals / $referralConfig['count']) * $referralConfig['count'];

      $profile = 50; // 50 + the five tests below = 100%
      $profile += $user->gender ? 10 : 0;
      $profile += $user->dob ? 10 : 0;
      $profile += $user->area_code ? 10 : 0;
      $profile += $user->phone ? 10 : 0;
      $profile += $user->image ? 10 : 0;

      $view
	      ->with('evercoinBalance', $evercoinBalance)
	      ->with('fb', $fb)
        ->with('tw', $tw)
        ->with('referrals', $referrals)
        ->with('numReferrals', $numReferrals)
        ->with('totalReferrals', $totalReferrals)
        ->with('profile', $profile)
	      ->with('id', $user->id);
  	}
}