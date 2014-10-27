<?php
 
class Gallery extends Eloquent {

    protected $table = 'gallery_defaults';
    protected $fillable = ['counter', 'keywords','image'];



    public static function selectImage($image_id) {

        $image = Gallery::find($image_id);

        $image->update(['counter' => ($image->counter - 1)]);

        return $image->image;

    }
    
}