<?php
 
class TrainerEditFormComposer {

	public function compose($view)
  	{

		$specialities = Speciality::all();
		$disciplines = array();
		$titles = array();
		foreach ($specialities as $sp)
		{
		    if (!isset($titles[$sp->name]))
		    {
		    	$disciplines[$sp->name] = $sp->name;
		    	$titles[$sp->name] = array($sp->titles);
		    }
		   	else array_push($titles[$sp->name], $sp->titles);
		}

		$gyms_data = Gym::all();
		$gyms = array();
		foreach ($gyms_data as $gym)
		{
		    $gyms[$gym->id] = $gym->name;
		}

		JavaScript::put(array('titles' => json_encode($titles), ));
		JavaScript::put(array('initTrainerTitles' => 1 )); // Initialise title swap Trainer JS.

		$view->with('disciplines', $disciplines)->with('gyms', $gyms);
	}
}
