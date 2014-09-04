<?php

/**
 * Class Place
 */
class Place extends \Eloquent
{

    protected $fillable = array('name', 'place_type', 'lng', 'lat', 'zone', 'poly_coordinates', 'coordinate_type');

    protected $table = 'places';

    public function link()
    {
        return $this->hasOne('Link', 'parent_id', 'id');
    }


    public static function moveAreaPermalinks()
    {


        die('NOT FOR USE RIGHT NOW');

        $areas = Place::all();
        foreach ($areas as $area) {

            $url = '';

            if ($area->permalink != 'COMPLETED') {
                //Generate URL
                if ($area->place_type == 'station') {
                    $url = 'london/station/'.$area->permalink;
                }
                if ($area->place_type == 'area') {
                    $url = 'london/area/'.$area->permalink;
                }

                $url = self::checkDuplicate($url);

                $link = new Link(['type' => $area->place_type, 'parent_id' => $area->id, 'permalink' => $url]);

                $save = $area->link()->save($link);

            }


        }


        echo "done";

    }


    public static function checkDuplicate($url)
    {

        do {
            $check = Link::where('permalink', $url)->count() > 0;

            if ($check) {
                if(strpos($url, '_') === false) {
                    $url .= '_0';
                }
                $url = ++$url;
            }
        } while ($check);

        return $url;

    }


}