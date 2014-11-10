<?php
 
class Gallery extends Eloquent {

    protected $table = 'gallery_defaults';
    protected $fillable = ['counter', 'keywords','image'];
    protected $hidden = ['created_at', 'updated_at'];


    
}