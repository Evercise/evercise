<?php

/**
 * Class Speciality
 */
class Speciality extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array('id', 'name', 'titles');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'specialities';


    /**
     * Concatenate name and title
     *
     * @return string
     */
    public function pluckSpecialityName()
    {
        return $this->attributes['name'] . ' ' . $this->attributes['titles'];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Trainers()
    {
        return $this->belongsTo('Trainer');
    }

}