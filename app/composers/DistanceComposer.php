<?php
 
class DistanceComposer {
 
  public function compose($view)
  {
    // get client location latlng

    $geocode = Functions::getPosition();

    $viewdata= $view->getData();

    $distanceMiles = array();

    $evercisegroups = $viewdata['evercisegroups'];

    foreach ( $evercisegroups as $key => $value) {
        $distance = Functions::getDistance( $geocode->getLatitude(), $geocode->getLongitude(), $value->lat, $value->lng);
        $distanceMiles[] = $distance->in('mi')->vincenty();
    }

    $view->with('miles', $distanceMiles);
  }
}