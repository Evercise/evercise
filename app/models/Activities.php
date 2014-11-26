<?php

/**
 * Class Areacodes
 */
class Activities extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array('id', 'type', 'type_id', 'description', 'user_id');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity';

}