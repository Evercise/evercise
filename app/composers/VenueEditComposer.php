<?php namespace composers;

use JavaScript;
use Venue;
use Facility;
use Sentry;


class VenueComposer {

	 public function compose($view)
  	{
      // Run the MapComposer composer, because it doesn't seem to run by itself
      (new MapComposer)->compose($view);

      //$venues = Venue::lists('name', 'id');
      $user = Sentry::getUser();

      $facilities = Facility::get();

      $viewdata= $view->getData();
      $venue = Venue::find($viewData['id']);
      
      $selectedFacilities = [];
      foreach($venue->facilities as $facility)
      {
        $selectedFacilities[] = $facility->id;
      }

      JavaScript::put(array('initVenues' => 1 ));

      $view->with('venue', $venue)->with('facilities', $facilities)->with('selectedFacilities', $selectedFacilities);
  	}
}