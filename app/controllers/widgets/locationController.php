<?php namespace widgets;

use Sentry, View, Geocoder, Exception, Request;


 
class LocationController extends \BaseController {

    public function getGeo() {

        $ip = Request::getClientIp();

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
            $geocode = $geocoder->geocode($ip);
            var_dump($geocode);
        } catch (Exception $e) {
            echo $e->getMessage();
        }        
    }
    
}