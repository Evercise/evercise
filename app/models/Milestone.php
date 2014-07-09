<?php

class Milestone extends \Eloquent {

	protected $fillable = array('id', 'user_id', 'referrals', 'profile', 'facebook', 'twitter', 'reviews');

	protected $table = 'milestones';



	public function add($type)
    {
    	$milestones = Config::get('milestones')['milestones'];

    	$column = $milestones[$type]['column'];

    	if ($milestones[$type]['recur'] == 1)
    	{
	        if ($this->attributes[$column] == 0)
	        {
	        	$this->attributes[$column] = 1;
	        	Evercoin::where('user_id', $this->attributes['user_id'])->first()->deposit(Evercoin::poundsToEvercoins($milestones[$type]['reward']));
	        	$this->save();
	        }
	    }
	    else if ($milestones[$type]['recur'] > 1)
	    {
	    	$this->attributes[$column] = $this->attributes[$column] + 1;

	    	if ($this->attributes[$column] <= $milestones[$type]['recur'])
	    	{
		        if ( !( $this->attributes[$column] % $milestones[$type]['count'] ) )
		        {
		        	Evercoin::where('user_id', $this->attributes['user_id'])->first()->deposit(Evercoin::poundsToEvercoins($milestones[$type]['reward']));
		        	
		        }
		    }

	        $this->save();
	    }
    }
	public function freeCoin($type)
	{
    	$freeCoins = Config::get('milestones')['freeCoins'];

		if (isset($freeCoins[$type]))
		{
			Evercoin::where('user_id', $this->attributes['user_id'])->first()->deposit(Evercoin::poundsToEvercoins($freeCoins[$type]));
		}
	}
}