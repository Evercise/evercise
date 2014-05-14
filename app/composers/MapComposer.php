<?php

require 'Functions.php';
 
class MapComposer {
 
  public function compose($view)
  {
    $geocode = Functions::getPosition();

    JavaScript::put(array('latitude' => json_encode( $geocode->getLatitude()) , 'longitude' => json_encode( $geocode->getLongitude()) )  );

	$view->with('houseNumber', $geocode->getStreetNumber())->with('streetName', $geocode->getStreetName())->with('city', $geocode->getCity())->with('postCode', $geocode->getZipcode());
  }
 
}