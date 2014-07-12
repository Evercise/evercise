<?php

class Sessionpayment extends \Eloquent {
	protected $fillable = ['user_id', 'evercisesession_id', 'total', 'total_after_fees', 'commission', 'processed'];

	/*
	Sessionpayment is a holding table to process payments from past classes into a trainers wallet.
	Accessed only by the commands (CheckPayments and CheckSessions), which are run on a cron
	CheckSessions will pick up a session which took place over 1 day ago, and make an entry in Sessionpayment
	CheckPayments will pick this up from Sessionpayment after 3 days, mark it processed, and credit the trainers wallet.
	*/
	
	public function user()
    {
        return $this->belongsTo('User');
    }

    public static function poundsToPennies($pounds)
    {
    	return ($pounds * 100);
    }

    public static function penniesToPounds($pennies)
    {
    	return ($pennies / 100);
    }

}
