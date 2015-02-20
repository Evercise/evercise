<?php

/**
 * Class Geo
 */
class Geo
{


    /**
     * @param $location
     * @return array
     */
    public static function getLatLng($location = false)
    {
        /* check for searched location, otherwise use the ip address */
        if (!$location) {
            $location = Request::getClientIp();
        }

        if ($location == '127.0.0.1' || $location == NULL || $location == '192.168.10.1' || $location == '192.168.50.50') {
            $location = '188.39.12.12';
        }


        $latitude = 0;
        $longitude = 0;

        /** Check if this is a IP or not */
        if (ip2long($location) !== FALSE) {

            try {
                $geocode = Geocoder::geocode($location);
                $latitude = $geocode->getLatitude();
                $longitude = $geocode->getlongitude();
            } catch (Exception $e) {
                //return $e->getMessage();
            }

        } else {
            if ($data = get_location($location)) {

                list($latitude, $longitude) = $data;
            }
        }

        return (['lat' => $latitude, 'lng' => $longitude]);
    }
}