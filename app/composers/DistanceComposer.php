<?php
 
class DistanceComposer {
 
  public function compose($view)
  {
    // get client location latlng

    $geocode = Functions::getPosition();

    $viewdata= $view->getData();

    $distanceMiles = array();

    foreach ($viewdata['evercisegroups'] as $key => $value) {
        $distance = Functions::getDistance( $geocode->getLatitude(), $geocode->getLongitude(), $value['lat'], $value['long']);
        $distanceMiles[] = $distance->in('mi')->vincenty();
    }

    $view->with('miles', $distanceMiles);
  }
}