<?php
 
class VenueComposer {

	 public function compose($view)
  	{
  		$venues = Venue::lists('name', 'id');

  		$view->with('venues', $venues);
  	}
}