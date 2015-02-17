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

    /**
     * Get an array of facilities and an array of amenities. [id, name]
     *
     * @return array
     */
    public static function getLists()
    {
        $amenities =  Facility::where('category', 'amenity')->lists('name', 'id' );
        $facilities = Facility::where('category', 'facility')->lists('name', 'id');

        return ['facilities' => $facilities, 'amenities' => $amenities];
    }

}