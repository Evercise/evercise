<?php

class Trainer extends \Eloquent {

	protected $fillable = array('user_id', 'bio', 'website', 'specialities_id', 'gender', 'profession');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trainers';

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getConfirmedTrainers()
    {
        $trainers = Static::with('user')->where('confirmed', 0)->get();
        return $trainers;
    }

    /**
     * @param $user
     */
    public static function approve($user)
    {

        try
        {
            Event::fire('user.upgrade', array(
                'email' => $user->email,
                'display_name' => $user->display_name
            ));
        }
        catch(Exception $e)
        {
            return 'Cannot send email. Trainer NOT approved' . $e;
        }

        Static::where('user_id', $user->id)->update(['confirmed' => 1]);

    }


    public function User()
    {
        return $this->belongsTo('User');
    }

    public function speciality()
    //return $this;
    {
        return $this->hasOne('Speciality' , 'id', 'specialities_id');
    }

    public static function createOrFail($params)
    {
    	$user_id = $params['user_id'];

    	if ( count( Trainer::where('user_id',$user_id)->get() ) < 1 )
    	{
			$newRecord = Trainer::create($params);
			return $newRecord;
		}
		else
		{
			return false;
		}
    }

    public Static function isTrainerLoggedIn()
    {
        if ( Sentry::check() ? (Sentry::getUser()->inGroup(Sentry::findGroupByName('trainer'))) : false )
            return true;
        else
            return false;
    }

}