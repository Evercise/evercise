<?php
 
class Functions {
 
  public static function getPosition()
  {
    $query = Request::getClientIp();

    if ($query = '127.0.0.1' || $query = null) {
        $query = '151.237.238.126';
    }

    $geocoder = new \Geocoder\Geocoder();
    $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();

    $chain    = new \Geocoder\Provider\ChainProvider(array(
                new \Geocoder\Provider\FreeGeoIpProvider($adapter),
                new \Geocoder\Provider\HostIpProvider($adapter),
                new \Geocoder\Provider\GoogleMapsProvider($adapter),
    ));

    $geocoder->registerProvider($chain);
    
    try {
        $geocode = $geocoder->geocode($query);
    } catch (Exception $e) {
        echo $e->getMessage();
    }   

    return $geocode;
  }

    public static function getDistance($clientLat, $clientLng, $lat, $lng)
  {
    $geotools = new \League\Geotools\Geotools();
    $coordA   = new \League\Geotools\Coordinate\Coordinate(array($clientLat, $clientLng));
    $coordB   = new \League\Geotools\Coordinate\Coordinate(array($lat, $lng));
    $distance = $geotools->distance()->setFrom($coordA)->setTo($coordB);

    return $distance;
  }
 
}