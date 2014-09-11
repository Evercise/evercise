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

        Evercoin::create(['user_id' => $user_id, 'balance' => 0]);
        Milestone::create(['user_id' => $user_id])->freeCoin('general_signup');
        Token::create(['user_id' => $user_id]);
    }

    /**
     * Check referral code from session, if it exists and is valid, mark it as used and credit the new user the specified amount of Evercoins
     *
     * @param bool $referal_code
     * @param int $user_id
     */
    public static function checkReferalCode($referral_code = false, $user_id = 0)
    {

        if ($referral = Referral::useReferralCode($referral_code, $user_id)) {
            Milestone::where('user_id', $referral->user_id)->first()->add('referral');
            Milestone::where('user_id', $user_id)->first()->freeCoin('referral_signup');

            Session::forget('referralCode');
        }
    }


    /**
     * Check PPC / Landing code from session, if it exists and is valid, mark it as used and credit the new user the specified amount of Evercoins
     *
     * @param bool $ppc_code
     * @param int $user_id
     */
    public static function checkLandingCode($ppc_code = false, $user_id = 0)
    {

        if ($landing = Landing::useLandingCode($ppc_code, $user_id)) {
            Milestone::where('user_id', $user_id)->first()->freeCoin('ppc_signup');
        }

        Session::forget('ppcCode');
    }

    /**
     * @param $user
     */
    public static function addToUserGroup($user)
    {
        try {
            // find the user group
            $userGroup = Sentry::findGroupById(1);
            // add the user to this group
            $user->addGroup($userGroup);
        } catch (Exception $e) {
            Log::error('cannot add to user group: ' . $e);
        }
    }

    /**
     * @param $user
     */
    public static function addToFbGroup($user)
    {
        try {
            $userGroup = Sentry::findGroupById(2);
            $user->addGroup($userGroup);
        } catch (Exception $e) {
            Log::error('cannot add to facebook group: ' . $e);
        }

    }

    /**
     * @param $inputs
     * @return string
     */
    public static function fbCheckForUserNameAndIncrement($inputs)
    {
        $check_display_name = $inputs['check_display_name'];
        if ($user_check = User::where('display_name', 'like', $check_display_name . '-%')->orderBy('created_at', 'desc')->first() ) {
            list($original_display_name, $int) = explode('-', $user_check->display_name);
            $number = (int)$int;
            $number++;
            $display_name = $original_display_name . '-' . $number;
        }
        elseif($display_name = User::where('display_name', $check_display_name)->pluck('display_name')){
            $display_name = $display_name.'-1';
        }
        else{
            $display_name = $check_display_name;
        }
        return $display_name;
    }

    /**
     * @param $user
     */
    public static function getResetPasswordAndEmailIt($user)
    {
        $reset_code = $user->getResetPasswordCode();

        Event::fire('user.forgot', array(
            'email' => $user->email,
            'displayName' => $user->display_name,
            'resetCode' => $reset_code
        ));
    }

    /**
     * @param $user
     */
    public static function changePasswordEvents($user)
    {
        Event::fire('user.changedPassword', [$user]);

        Event::fire(
            'user.newpassword',
            [
                'email' => $user->email
            ]
        );

        Session::flash('notification', 'Password reset successful');
    }
} 