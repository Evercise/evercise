<?php

/**
 * Class FakeRating
 */
class FakeRating extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'evercisegroup_id', 'stars', 'comment'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fakeratings';

    /* the user that rated this class */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rator()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evercisegroup()
    {
        return $this->belongsTo('evercisegroup', 'evercisegroup_id');
    }
}