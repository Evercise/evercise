<?php

class UserHelper
{


    /**
     * Generate the user default data
     * @param int $user_id
     */
    public static function generateUserDefaults($user_id = 0)
    {
        if ($user_id < 1) {
            return false;
        }

        Wallet::createIfDoesntExist($user_id);
        Milestone::createIfDoesntExist($user_id);
        Token::createIfDoesntExist($user_id);
    }

    /**
     * Check referral code from session, if it exists and is valid, mark it as used and credit the new user the specified amount of Evercoins
     *
     * @param bool $referal_code
     * @param int $user_id
     */
    public static function checkAndUseReferralCode($referral_code = false, $user_id = 0)
    {

        if ($referral = Referral::useReferralCode($referral_code, $user_id)) {
            Log::info('using referral code: ' . $referral_code. ' user id: '.$user_id);
            Milestone::where('user_id', $referral->user_id)->first()->add('referral');
            Milestone::where('user_id', $user_id)->first()->milestoneComplete('referral_signup');

            Session::forget('referralCode');
        }
    }


    /**
     * Check PPC / Landing code from session, if it exists and is valid, mark it as used and credit the new user the specified amount of Evercoins
     *
     * @param bool $ppc_code
     * @param int $user_id
     */
    public static function checkAndUseLandingCode($ppc_code = false, $user_id = 0)
    {

        if ($landing = Landing::useLandingCode($ppc_code, $user_id)) {
            $wallet = Wallet::where('user_id', $user_id)->first();

            $type = 'ppc_signup';
            $freeCoins = Config::get('values')['freeCoins'];
            if (isset($freeCoins[$type])) {
                $wallet->giveAmount($freeCoins[$type], $type);
            }
        }
        else if ($staticLanding = StaticLanding::useLandingCode($ppc_code, $user_id)) {
            $wallet = Wallet::where('user_id', $user_id)->first();

            $wallet->giveAmount($staticLanding->amount, 'static_ppc_signup', $staticLanding->description);
        }

        Session::forget('ppcCode');
    }
} 