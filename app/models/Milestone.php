<?php

class Milestone extends \Eloquent {

	protected $fillable = array('id', 'user_id', 'referrals', 'profile', 'facebook', 'twitter', 'reviews');

	protected $table = 'milestones';

	// count - How many to count to before a reward is given
	// reward - Amount rewarded in pounds
	// Recur - Number of times the award can be claimed 
	private $milestones = [
		'referral' => ['count'=>3, 'reward'=>1, 'recur'=>100, 'column'=>'referrals'],
		'profile' => ['count'=>1, 'reward'=>1, 'recur'=>1, 'column'=>'profile'],
		'facebook' => ['count'=>1, 'reward'=>1, 'recur'=>1, 'column'=>'facebook'],
		'twitter' => ['count'=>1, 'reward'=>1, 'recur'=>1, 'column'=>'twitter'],
		'review' => ['count'=>5, 'reward'=>5, 'recur'=>100, 'column'=>'reviews'],
	];
	private $freeCoins = [
		'referral_signup' => 1,
	];

	public function add($type)
    {
    	$column = $this->milestones[$type]['column'];

    	if ($this->milestones[$type]['recur'] == 1)
    	{
	        if ($this->attributes[$column] == 0)
	        {
	        	$this->attributes[$column] = 1;
	        	Evercoin::where('user_id', $this->attributes['user_id'])->first()->deposit(Evercoin::poundsToEvercoins($this->milestones[$type]['reward']));
	        	$this->save();
	        }
	    }
	    else if ($this->milestones[$type]['recur'] > 1)
	    {
	    	$this->attributes[$column] = $this->attributes[$column] + 1;

	    	if ($this->attributes[$column] <= $this->milestones[$type]['recur'])
	    	{
		        if ( !( $this->attributes[$column] % $this->milestones[$type]['count'] ) )
		        {
		        	Evercoin::where('user_id', $this->attributes['user_id'])->first()->deposit(Evercoin::poundsToEvercoins($this->milestones[$type]['reward']));
		        	
		        }
		    }

	        $this->save();
	    }
    }
	public function freeCoin($type)
	{
		if (isset($this->milestones[$type]))
		{
			Evercoin::where('user_id', $this->attributes['user_id'])->first()->deposit(Evercoin::poundsToEvercoins($this->milestones[$type]));
		}
	}
}