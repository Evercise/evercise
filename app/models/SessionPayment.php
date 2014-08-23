<?php

/**
 * Class Sessionpayment
 *
 * Sessionpayment is a holding table to process payments from past classes into a trainers wallet.
 * Accessed only by the commands (CheckPayments and CheckSessions), which are run on a cron
 * CheckSessions will pick up a session which took place over 1 day ago, and make an entry in Sessionpayment
 * CheckPayments will pick this up from Sessionpayment after 3 days, mark it processed, and credit the trainers wallet.
 */
class Sessionpayment extends \Eloquent
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'evercisesession_id', 'total', 'total_after_fees', 'commission', 'processed'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Convert Pounds to Pennies
     *
     * @param $pounds
     * @return mixed
     */
    public static function poundsToPennies($pounds)
    {
        return ($pounds * 100);
    }

    /**
     * Convert Pennies to Pounds
     *
     * @param $pennies
     * @return float
     */
    public static function penniesToPounds($pennies)
    {
        return ($pennies / 100);
    }

}
