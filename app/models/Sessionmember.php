<?php

class Sessionmember extends \Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sessionmembers';


	

    public function Users()
    {
        return $this->belongsTo('User' , 'user_id');
    }

}