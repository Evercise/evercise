<?php

use Carbon\Carbon;

/**
 * Class Sessionmember
 */
class Sessionmember extends \Eloquent
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'evercisesession_id', 'token', 'transaction_id', 'payer_id', 'payment_method'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sessionmembers';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Users()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function rating()
    {
        return $this->hasOne('Rating');
    }

    public static function todaysSales()
    {
        return count(DB::table('sessionmembers')->where('created_at', '>=', Carbon::now()->setTime(0, 0, 0))->get());
    }

    public function session()
    {
        return $this->belongsTo('Evercisesession', 'evercisesession_id');
    }

}