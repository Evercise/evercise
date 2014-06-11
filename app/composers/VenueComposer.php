<?php
 
class VenueComposer {

	 public function compose($view)
  	{
  		// Run the MapComposer composer, because it doesn't seem to run by itself
  		(new MapComposer)->compose($view);

  		//$venues = Venue::lists('name', 'id');
  		$user = Sentry::getUser();
  		$venues = Venue::where('user_id', $user->id)->lists('name', 'id');

  		$facilities = Facility::get();

		JavaScript::put(array('initVenues ' => 1 ));
		//JavaScript::put(array('MapWidgetloadScript ' => 1 ));
  		$view->with('venues', $venues)->with('facilities', $facilities);
  	}
}