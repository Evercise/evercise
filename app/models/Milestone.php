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


    /**
     *
     *
     * @param $type
     */
    public function add($type)
    {
        $milestones = Config::get('values')['milestones'];

        $column = $milestones[$type]['column'];

        if ($milestones[$type]['recur'] == 1) {
            if ($this->attributes[$column] == 0) {
                $this->attributes[$column] = 1;
                Evercoin::where('user_id', $this->attributes['user_id'])->first()->deposit(
                    Evercoin::poundsToEvercoins($milestones[$type]['reward'])
                );
                $this->save();
            }
        } else {
            if ($milestones[$type]['recur'] > 1) {
                $this->attributes[$column] = $this->attributes[$column] + 1;

                if ($this->attributes[$column] <= ($milestones[$type]['recur'] * $milestones[$type]['count'])) {
                    if (!($this->attributes[$column] % $milestones[$type]['count'])) {
                        Evercoin::where('user_id', $this->attributes['user_id'])->first()->deposit(
                            Evercoin::poundsToEvercoins($milestones[$type]['reward'])
                        );

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
    public function freeCoin($type)
    {
        $freeCoins = Config::get('values')['freeCoins'];

        if (isset($freeCoins[$type])) {
            Evercoin::where('user_id', $this->attributes['user_id'])->first()->deposit(
                Evercoin::poundsToEvercoins($freeCoins[$type])
            );
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
}