<?php
 
class DistanceComposer {
 
  public function compose($view)
  {
    // get client location latlng

    $geocode = Functions::getPosition();

    $viewdata= $view->getData();

    $distanceMiles = 0;

    $lat = $viewdata['lat'];
    $lng = $viewdata['lng'];
    //$lat = 51.50682494;
    //$lng = -0.15704746;

    $distance = Functions::getDistance( $geocode->getLatitude(), $geocode->getLongitude(), $lat, $lng);
    //$distance = Functions::getDistance( 50.01, -0.19, $lat, $lng);
    $distanceMiles = $distance->in('mi')->vincenty();

    $view->with('distance', $distanceMiles);
  }
}