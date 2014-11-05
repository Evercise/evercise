<?php
 
class VenueImages extends Eloquent {

    protected $table = 'venue_images';
    protected $fillable = ['venue_id', 'file', 'thumb'];

    public function venue()
    {
        return $this->belongsTo('Venue');
    }
    
}