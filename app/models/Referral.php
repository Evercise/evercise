<?php

class Referral extends \Eloquent {

	protected $fillable = array('id', 'user_id', 'email', 'code', 'referee_id');

	protected $table = 'referrals';

	public static function checkReferralCode($rc)
	{
		$referralCode = 0;
		if( ! is_null($rc))
		{
			if ( ! is_null(Referral::where('code', $rc)->first()))
			{
				$referralCode = $rc;
			}
		}
		return $referralCode;
	}
	public static function useReferralCode($rc, $user_id)
	{
		$referralCode = 0;
		if(Referral::checkReferralCode($rc))
		{
			$referralCode = $rc;
			Referral::where('code', $rc)->first()->update(['code' => '', 'referee_id' => $user_id]);
		}
		return $referralCode;
	}
}