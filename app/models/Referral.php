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
        $referral = 0;
        if (!is_null($rc)) {
            $referral = static::where('code', $rc)->where('referee_id', 0)->first();
        }
        return $referral;
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
        if (static::checkReferralCode($rc)) {
            $referral = static::where('code', $rc)->first();
            $referral->update(['referee_id' => $user_id]);

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

    public static function checkAndStore($user_id, $email, $code)
    {
        $referral = static::create(['user_id' => $user_id, 'email' => $email, 'code' => $code, 'referee_id' => 0]);

        return $referral;
    }
}