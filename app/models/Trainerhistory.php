<?php

class Trainerhistory extends \Eloquent {

	protected $fillable = array('user_id', 'message');
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
				break;
    		case 'deleted_session':
				$message = $params['display_name'].' has deleted '.$params['name'].' at '.$params['time'].' on the '.$params['date'];
				break;
    		case 'created_evercisegroup':
				$message = $params['display_name'].' created Class '.$params['name'];
				break;
    		case 'created_session':
				$message = $params['display_name'].' added a new date to '.$params['name'].' at '.$params['time'].' on the '.$params['date'];
				break;
    		case 'joined_session':
				$message = $params['display_name'].' has joined '.$params['name'].' at '.$params['time'].' on the '.$params['date'];
				break;
		}
		if (isset($message))
		{
			$data = array('user_id'=>$params['user_id'], 'message'=>$message);
       		parent::create($data);
		}

    }
}