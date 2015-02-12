<?php

/**
 * Class Milestone
 */
class Milestone extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'referrals', 'profile', 'facebook', 'twitter', 'reviews'];

    /**
     * @var string
     */
    protected $table = 'milestones';

//
//'milestones' => [
//'referral' => 		['count'=>3,	'reward'=>5, 	'recur'=>2,  	'column'=>'referrals'	],
//'profile' => 			['count'=>1,	'reward'=>.5,	'recur'=>1,  	'column'=>'profile'		],
//'facebook' => 		['count'=>1,	'reward'=>.5,	'recur'=>1,  	'column'=>'facebook'	],
//'twitter' => 			['count'=>1,	'reward'=>.5,	'recur'=>1,  	'column'=>'twitter'		],
//'review' => 			['count'=>5,	'reward'=>5, 	'recur'=>10, 	'column'=>'reviews'		],
//],


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     *
     *
     * @param $type
     */
    public function add($type)
    {
        $milestones = Config::get('values')['milestones'];

        $column = $milestones[$type]['column'];

        $user = Sentry::findUserById($this->attributes['user_id']);

        $wallet = $user->getWallet();

        if ($milestones[$type]['recur'] == 1) {
            if ($this->attributes[$column] == 0) {
                $this->attributes[$column] = 1;
                MilestoneRewards::add($type, $milestones[$type]['reward'], $user);

                $this->save();
                Log::info('User ' .$user->id. ' has been awarded '. $milestones[$type]['reward']. 'for referring friends');
            }
        } else {
            if ($milestones[$type]['recur'] > 1) {
                $this->attributes[$column] = $this->attributes[$column] + 1;
                if ($this->attributes[$column] <= ($milestones[$type]['recur'] * $milestones[$type]['count'])) {
                    if (!($this->attributes[$column] % $milestones[$type]['count'])) {

                        MilestoneRewards::add($type, $milestones[$type]['reward'], $user);

                        Log::info('User ' .$user->id. ' has been awarded '. $milestones[$type]['reward']. 'for referring friends');

                    }
                }
                $this->save();
            }
        }
    }

    /**
     * Assign Free coins to User
     * @param $type
     */
    public function milestoneComplete($type)
    {
        $freeCoins = Config::get('values')['freeCoins'];
        if (isset($freeCoins[$type])) {

            MilestoneRewards::add($type, $freeCoins[$type], $this->user);

        }
    }


    public static function createIfDoesntExist($user_id)
    {
        if (static::where('user_id', $user_id)->first())
            return false;

        $milestone = static::firstOrCreate([
            'user_id'=>$user_id,
            'referrals'=>0,
            'profile'=>0,
            'facebook'=>0,
            'twitter'=>0,
            'reviews'=>0,
        ]);

        return $milestone;
    }

    public function showReferrals()
    {
/*        $total = ceil($this->referrals / Config::get('values')['milestones']['referral']['count']) * Config::get('values')['milestones']['referral']['count'];
        return $this->referrals .'/'. $total;*/

        return $this->referrals;
    }
}