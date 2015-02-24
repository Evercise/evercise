<?php
use Carbon\Carbon;

/**
 * Class PendingEvercisegroup
 */
class PendingEvercisegroup extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'venue_id',
        'name',
        'description',
        'image',
        'status'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pending_evercisegroups';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function evercisegroup()
    {
        return $this->belongsTo('Evercisegroup');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('User');
    }
}