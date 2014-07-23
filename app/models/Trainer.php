<?php

class Trainer extends \Eloquent {

	protected $fillable = array('user_id', 'bio', 'website', 'specialities_id', 'gender', 'profession');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trainers';

	public function User()
    {
        return $this->belongsTo('User');
    }

    public function speciality()
    //return $this;
    {
        return $this->hasOne('Speciality' , 'id', 'specialities_id');
    }

    public static function upgradeToTrainer($params)
    {
    	$user_id = $params['user_id'];

    	if (! count( Trainer::where('user_id',$user_id) ) )
    	{
			$newRecord = $this->create($params);
			return $newRecord;
		}
		else
		{
			return false;
		}
    }

}