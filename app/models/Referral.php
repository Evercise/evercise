<?php

/**
 * Class Referral
 */
class Referral extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'email', 'code', 'referee_id'];

    /**
     * @var string
     */
    protected $table = 'referrals';

    /**
     * Check the Referral Code
     *
     * @param $rc
     * @return int
     */
    public static function checkReferralCode($rc)
    {
        $referralCode = 0;
        if (!is_null($rc)) {
            if (!is_null(Referral::where('code', $rc)->first())) {
                $referralCode = $rc;
            }
        }
        return $referralCode;
    }

    /**
     * User Referral Code
     * @param $rc
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Model|int|null|static
     */
    public static function useReferralCode($rc, $user_id)
    {
        $referral = 0;
        if (Referral::checkReferralCode($rc)) {
            $referral = Referral::where('code', $rc)->first();
            $referral->update(['code' => '', 'referee_id' => $user_id]);
        }
        return $referral;
    }

    public static function validateEmail($inputs)
    {

        $validator = Validator::make(
            $inputs,
            [
                'referee_email' => 'required|email|unique:users,email',
            ]
        );
        return $validator;
    }
}