<?php

/**
 * Class Rating
 */
class Rating extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array(
        'id',
        'user_id',
        'sessionmember_id',
        'session_id',
        'evercisegroup_id',
        'user_created_id',
        'stars',
        'comment'
    );

    /**
     * @var string
     */
    protected $table = 'ratings';

    /* the user this rating belongs to */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /* the user that rated this class */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rator()
    {
        return $this->belongsTo('User', 'user_created_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evercisegroup()
    {
        return $this->belongsTo('evercisegroup', 'evercisegroup_id');
    }
}