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
    public static function getLatLng($location)
    {
        /* check for searched location, otherwise use the ip address */
        if ($location == '') {
            $location = Request::getClientIp();
        }

        if ($location == '127.0.0.1' || $location == null) {
            $location = '188.39.12.12';
        }

        try {
            $geocode = Geocoder::geocode($location);
            $latitude = $geocode->getLatitude();
            $longitude = $geocode->getlongitude();
        } catch (Exception $e) {
            //return $e->getMessage();
            $latitude = 0;
            $longitude = 0;
        }
        return (['lat' => $latitude, 'lng' => $longitude]);
    }
}