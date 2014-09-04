<?php

/**
 * Class Links
 */
class Link extends \Eloquent
{


    protected $fillable = array('permalink', 'parent_id', 'type');

    protected $table = 'evercise_links';

    protected $primaryKey = 'link_id';


    public function getClass()
    {
        return $this->belongsTo('Evercisegroup', 'parent_id', 'id');
    }

    public function getArea()
    {
        return $this->belongsTo('Place', 'parent_id', 'id');
    }


    public static function checkLink($url)
    {
        $check = Link::where('permalink', $url)->first();

        if (!empty($check->permalink)) {
            return $check;
        }

        return false;
    }


}