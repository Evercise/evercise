<?php

/**
 * Class Trainer
 */
class Trainer extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array('user_id', 'bio', 'website', 'specialities_id', 'gender', 'profession');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trainers';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function speciality()
        //return $this;
    {
        return $this->hasOne('Speciality', 'id', 'specialities_id');
    }

    /**
     *
     *
     * @param $params
     * @return bool|\Illuminate\Database\Eloquent\Model|static
     */
    public static function createOrFail($params)
    {
        $user_id = $params['user_id'];

        if (count(Trainer::where('user_id', $user_id)->get()) < 1) {
            $newRecord = Trainer::create($params);
            return $newRecord;
        } else {
            return false;
        }
    }

}