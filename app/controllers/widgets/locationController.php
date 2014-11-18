<?php namespace widgets;

use Sentry, View, Geocoder, Exception, Request, Response, JavaScript, Input, Session;


 
class LocationController extends \BaseController {

    public function getGeo() {

       
    }

    public function postGeo() {
        $ip = Request::getClientIp();

        $address = array_values(Input::get());

        $address = implode(',', $address);

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
           
            $geocode = $geocoder->geocode($address);

            JavaScript::put(array('latitude' => json_encode( $geocode->getLatitude()) , 'longitude' => json_encode( $geocode->getLongitude()) )  );

            return Response::json(array('lat' => $geocode->getLatitude(), 'lng' => $geocode->getLongitude() ));

        } catch (Exception $e) {
             return Response::json(array('error' => $e->getMessage()));
        }        
    }

    public function getMap() {
        return View::make('widgets/map');
    }


    public static function addressToGeo($address) {

        $address = implode(',', $address);

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

            $geocode = $geocoder->geocode($address);

            JavaScript::put(array('latitude' => json_encode( $geocode->getLatitude()) , 'longitude' => json_encode( $geocode->getLongitude()) )  );

            return ['lat' => $geocode->getLatitude(), 'lng' => $geocode->getLongitude() ];

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    
}