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


    public static function checkLink($url, $area_id = false)
    {

        if($url == '') {
            return false;
        }

        if($area_id == '') $area_id = false;
        if($area_id) {
            $place = Place::find($area_id);
            $check = $place->link;
        } else {
            $check = Link::where('permalink', $url)->first();
        }

        if (!empty($check->permalink)) {
            return $check;
        }

        return false;
    }


    public static function getUniqueUrl($url)
    {
        do {
            $check = Link::where('permalink', $url)->count() > 0;

            if ($check) {
                if (strpos($url, '_') === false) {
                    $url .= '_0';
                }
                $url = ++ $url;
            }
        } while ($check);

        return $url;

    }


}