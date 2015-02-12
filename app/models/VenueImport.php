<?php

class VenueImport extends \Eloquent
{


    protected $fillable = array('id', 'user_id', 'name', 'address', 'town', 'postcode', 'lat', 'lng', 'image', 'source', 'external_id', 'venue_id');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'venue_import';


}