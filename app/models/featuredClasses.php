<?php

class FeaturedClasses extends \Eloquent
{
    /**
     * @var array
     */
    protected $fillable = ['evercisegroup_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'featured_evercisegroups';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evercisegroup()
    {
        return $this->belongsTo('evercisegroup', 'evercisegroup_id');
    }

}