<?php

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

}