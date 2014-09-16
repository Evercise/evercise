<?php

/**
 * Class Place
 */
class Place extends \Eloquent
{

    protected $fillable = array('name', 'place_type', 'lng', 'lat', 'min_radius', 'zone', 'poly_coordinates', 'coordinate_type');

    protected $table = 'places';

    public function link()
    {
        return $this->hasOne('Link', 'parent_id', 'id');
    }


    public static function getByLocation($location = '')
    {

        /** First Check the Location if it exists  */
        if (!empty($location)) {

            /** We now have to create a lot of shit to get this working */

            $is_london = true;
            $is_area = true;
            $zip_code = false;

            if (strpos($location, ',') !== false) {
                $location = explode(',', $location);
            } else {
                $location = [$location];
            }


            /** Remove London and united kingdom from Googles Crap */
            foreach ($location as $i => $val) {
                if (trim($val) == 'United Kingdom') {
                    unset($location[$i]);
                } elseif (stripos($val, 'United Kingdom') !== false) {
                    $location[$i] = trim(str_ireplace('United Kingdom', '', $val));
                }

                if (trim($val) == 'London') {
                    $is_london = true;
                    unset($location[$i]);
                } elseif (stripos($val, 'London') !== false) {
                    /** London Sometimes at the front of the row London N1 0QH,  Kingdom */
                    $is_london = true;
                    $location[$i] = trim(str_ireplace('London', '', $val));

                    if ($location[$i] == '') {
                        unset($location[$i]);
                    }
                }

                if (!empty($location[$i]) && stripos($val, 'station') !== false) {
                    $is_area = false;
                    $location[$i] = trim(str_ireplace('station', '', $location[$i]));
                    if ($location[$i] == '') {
                        unset($location[$i]);
                    }
                }


                /** Check for a zip Code */
                if (!empty($location[$i]) && preg_match(
                        '#^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$#',
                        trim(strtoupper($location[$i]))
                    )
                ) {

                    $zip_code = strtoupper(trim($location[$i]));
                    unset($location[$i]);
                }
            }




            $name = implode(' ', $location);

            $location = Str::slug($name);

            $name .= ($is_london && strpos($name, 'london') === false ? ' London':'');
            $name .= (!$is_area && strpos($name, 'station') === false ? ' Station':'');

            $return = [];

            $type = 'AREA';
            if ($is_london) {
                $return[] = 'london';
            }
            if ($is_area && !$zip_code) {
                $return[] = 'area';
            }

            if (!$is_area) {
                $return[] = 'station';
                $type = 'STATION';
            }

            if ($zip_code) {
                $type = 'ZIP';
                $return = ['zip', Str::slug($zip_code)];
                $name = $zip_code;
            }

            $return[] = $location;

            /** @var  $return  REMOVE EMPTY Array fields*/
            $return = array_filter($return);

            $location_url = implode('/', $return);
            if(substr($location_url, -4) == 'area') {
                $location_url = str_replace('/area', '', $location_url);
            }

            return self::checkLocation($location_url, $name, $type, $is_london, $zip_code);

        }
    }


    public static function checkLocation($url, $name, $type, $is_london=false, $is_zip = false)
    {
        $url = rtrim((string)$url,'/');
        $link = Link::where('permalink', $url)->first();


        if (count($link) == 0) {
            /** This crap is new.. so lets add it and figure out where the f* is it */


            $geo = self::getGeo($name, $is_london, $is_zip);

            $link = new Link(['permalink' => $url, 'type' => $type]);

            $data = [
                'name'             => (string)$name,
                'place_type'       => 1,
                'lng'              => $geo['lng'],
                'lat'              => $geo['lat'],
                'zone'             => 0,
                'poly_coordinates' => '',
                'coordinate_type'  => 'Radious'
            ];

            $place = static::create($data)->link()->save($link)->getArea;

        } else {
            $place = $link->getArea;
        }

        return $place;
    }


    public static function getGeo($location, $is_london, $is_zip)
    {

        $geocoder = new \Geocoder\Geocoder();
        $adapter = new \Geocoder\HttpAdapter\CurlHttpAdapter();

        $chain = new \Geocoder\Provider\ChainProvider(
            [
                new \Geocoder\Provider\FreeGeoIpProvider($adapter),
                new \Geocoder\Provider\HostIpProvider($adapter),
                new \Geocoder\Provider\GoogleMapsProvider($adapter)
            ]
        );

        $geocoder->registerProvider($chain);

        try {

            $addition = $location.($is_zip ? ' UK':'').($is_london ? ' London':'');

            $geocode = $geocoder->geocode($addition);

            return ['lat' => $geocode->getLatitude(), 'lng' => $geocode->getLongitude()];

        } catch (Exception $e) {
            /** Since this will return a 0 0 in the middle of the ocean.  */
            /** Lets set london */
            return ['lat' => 51.517961, 'lng' => -0.126318];
        }
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
                    $url = 'london/station/' . $area->permalink;
                }
                if ($area->place_type == 'area') {
                    $url = 'london/area/' . $area->permalink;
                }

                $url = self::checkDuplicate($url);

                $link = new Link(['type' => $area->place_type, 'parent_id' => $area->id, 'permalink' => $url]);

                $save = $area->link()->save($link);

            }


        }


    }


    public static function checkDuplicate($url)
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