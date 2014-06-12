<?php
 
class UserClassesComposer {

	 public function compose($view)
  	{
  		$user = Sentry::getUser();
  		$userId = $user->id;

        //$evercisegroups = Evercisegroup::with('Evercisesession.Sessionmembers')
        //->where('sessionmembers.user_id', $user->id)
	    //->get();


		/*$evercisegroups = Evercisegroup::with(
			array('evercisesession.sessionmembers' => function($query) use (&$userId)
			{

				$query->where('user_id', $userId);

			}),
			'evercisesession.sessionmembers'
		)->get();*/

		/*$evercisegroups = Evercisegroup::with('Evercisesession.Sessionmembers')
		->whereHas('sessionmembers', function($query) use (&$userId)
		{
		    $query->where('user_id', $userId);

		})->get();*/

		$sessions = Evercisesession::whereHas('sessionmembers', function($query) use (&$userId)
		{
		    $query->where('user_id', $userId);

		})->orderBy('date_time', 'asc')->get();

		$groupsWithKeys = [];
	    $members = [];
		$group_ids = [];
		if($sessions->count())
		{
				foreach ($sessions as $session_id => $session)
				{
					if (!in_array($session->evercisegroup_id, $group_ids))
					{
						$group_ids[] = $session->evercisegroup_id;
					}
					$members[$session->id] = count($session->sessionmembers); // Count those members
				}


		        $groups = Evercisegroup::with('Evercisesession.Sessionmembers')
		        ->whereIn('id', $group_ids)
			    ->get();

				// var_dump($evercisegroups[1]->evercisesession);
				// exit;


				foreach ($groups as $key => $group)
				{
					$groupsWithKeys[$group->id] = $group;

					/*foreach ($group->evercisesession as $evercisesession_id => $evercisesession)
					{
						$members[$group->id][] = count($evercisesession->sessionmembers); // Count those members
				}*/
			}
		}
  		$view->with('groups', $groupsWithKeys)
	  		 ->with('sessions', $sessions)
	  		 ->with('members', $members);
  	}
}