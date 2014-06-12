<?php
 
class UserHistoryComposer {

	 public function compose($view)
  	{

        $evercisegroups = Evercisegroup::with('user')->with('Evercisesession.Sessionmembers')
	    ->get();

	    $members = [];
	    foreach ($evercisegroups as $evercisegroup_id => $evercisegroup) {
			foreach ($evercisegroup->evercisesession as $evercisesession_id => $evercisesession) {
				$members[$evercisegroup_id][] = count($evercisesession->sessionmembers); // Count those members
			}
		}

  		$view->with('evercisegroups', $evercisegroups)->with('members', $members);
  	}
}