<?php

/**
 * Class Facility
 */
class Facility extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'category', 'details', 'image'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facilities';

}