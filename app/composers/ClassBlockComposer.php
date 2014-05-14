<?php
 
class ClassBlockComposer {
 
  public function compose($view)
  {
    $query = Request::getClientIp();

    if ($query = '127.0.0.1' || $query = null) {
        $query = '151.237.238.126';
    }

    $geocoder = new \Geocoder\Geocoder();
    $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();
    $provider = new \Geocoder\Provider\GoogleMapsProvider($adapter);

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

    $geotools = new \League\Geotools\Geotools();
    $coordA   = new \League\Geotools\Coordinate\Coordinate(array($geocode->getLatitude(), $geocode->getLongitude()));
    $coordB   = new \League\Geotools\Coordinate\Coordinate(array(43.296482, 5.36978));
    $distance = $geotools->distance()->setFrom($coordA)->setTo($coordB);

    $view->with('distance', $distance->in('mi')->vincenty());
  }
 
}