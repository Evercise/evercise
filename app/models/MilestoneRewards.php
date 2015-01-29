<?php

/**
 * Class Milestone
 */
class MilestoneRewards extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'amount', 'message', 'status'];

    /**
     * @var string
     */
    protected $table = 'milestone_rewards';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    public static function clearUser($userId) {

        return static::where('user_id', $userId)->where('status', 0)->update('status', '1');

    }

    public static function add($type, $amount, $user)
    {
        if (!$type || $amount == 0) {
            return FALSE;
        }


        $desc = FALSE;

        switch ($type) {
            case 'referral_signup':
                event('user.referral.signup', [$user, $amount, 'referralsignup']);
                $desc = 'Referral signup';
                break;
            case 'ppc_signup':
                event('user.ppc.signup', [$user, $amount, 'ppcunique']);
                $desc = 'PPC Signup';
                break;
            case 'static_ppc_signup':
                event('user.ppc.signup', [$user, $amount, 'ppcstatic']);
                $desc = 'Static PPC Signup';
                break;
            case 'referral':
                event('user.referral.completed', [$user, $amount, 'referralcompleted']);
                $desc = 'Friend Referral';
                break;
            case 'profile':
                $desc = 'Completed Profile';
                break;
            case 'facebook':
                $desc = 'Connected  Facebook account';
                break;
            case 'twitter':
                $desc = 'Connected  Twitter account';
                break;
            case 'review':
                $desc = 'Wrote a review';
                break;

            default:
                return FALSE;
        }

        if ($desc) {
            $reward = static::create([
                'amount'  => round($amount, 2),
                'message' => $desc,
                'status'  => 0,
                'user_id' => $user->id
            ]);

            return TRUE;
        }

        return FALSE;

    }

}