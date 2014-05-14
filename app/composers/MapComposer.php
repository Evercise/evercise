<?php
 
class MapComposer {
 
  public function compose($view)
  {
    $query = Request::getClientIp();

    if ($query = '127.0.0.1' || $query = null) {
        $query = '151.237.238.126';
    }

    $geocoder = new \Geocoder\Geocoder();
    $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();
    //$provider = new \Geocoder\Provider\GoogleMapsProvider($adapter);

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

    JavaScript::put(array('latitude' => json_encode( $geocode->getLatitude()) , 'longitude' => json_encode( $geocode->getLongitude()) )  );

	$view->with('houseNumber', $geocode->getStreetNumber())->with('streetName', $geocode->getStreetName())->with('city', $geocode->getCity())->with('postCode', $geocode->getZipcode());
  }
 
}