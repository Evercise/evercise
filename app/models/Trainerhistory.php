<?php

class Trainerhistory extends \Eloquent {

	protected $fillable = array('user_id', 'historytype_id' ,'message');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trainerhistory';


    public static function create(array $params)
    {
    	switch($params['type'])
    	{
    		case 'deleted_evercisegroup':
				$message = $params['display_name'].' has deleted '.$params['name'];
				$typeId = 3; // these need changing so they are picked up from the database
				break;
    		case 'deleted_session':
				$message = $params['display_name'].' has deleted '.$params['name'].' at '.$params['time'].' on the '.$params['date'];
				$typeId = 4; // these need changing so they are picked up from the database
				break;
    		case 'created_evercisegroup':
				$message = $params['display_name'].' created Class '.$params['name'];
				$typeId = 1; // these need changing so they are picked up from the database
				break;
    		case 'created_session':
				$message = $params['display_name'].' added a new date to '.$params['name'].' at '.$params['time'].' on the '.$params['date'];
				$typeId = 2; // these need changing so they are picked up from the database
				break;
    		case 'joined_session':
				$message = $params['display_name'].' has joined '.$params['name'].' at '.$params['time'].' on the '.$params['date'];
				$typeId = 5; // these need changing so they are picked up from the database
				break;
    		case 'rated_session':
				$message = $params['display_name'].' has left a review of '.$params['name'].' at '.$params['time'].' on the '.$params['date'];
				$typeId = 6; // these need changing so they are picked up from the database
				break;
    		case 'left_session_full':
				$message = $params['display_name'].' has left '.$params['name'].' at '.$params['time'].' on the '.$params['date'].' with a full refund';
				$typeId = 7; // these need changing so they are picked up from the database
				break;
    		case 'left_session_half':
				$message = $params['display_name'].' has left '.$params['name'].' at '.$params['time'].' on the '.$params['date'].' with a 50% refund';
				$typeId = 8; // these need changing so they are picked up from the database
				break;
		}
		if (isset($message))
		{
			$data = array('user_id'=>$params['user_id'], 'historytype_id' => $typeId , 'message'=>$message);
       		parent::create($data);
		}

    }
}