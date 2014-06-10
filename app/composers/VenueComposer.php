<?php
 
class VenueComposer {

	 public function compose($view)
  	{
  		$venues = Venue::lists('name', 'id');

  		$facilities = Facility::get();

  		$view->with('venues', $venues)->with('facilities', $facilities);
  	}
}