<?php
 
class UserClassesFutureComposer {

	 public function compose($view)
  	{
  		$user = Sentry::getUser();
  		$userId = $user->id;

		$sessions = Evercisesession::whereHas('users', function($query) use (&$userId)
		{
		    $query->where('user_id', $userId);

		})->orderBy('date_time', 'asc')->get();

		$groupsWithKeys = [];
	    $members = [];
		if($sessions->count())
		{
			$group_ids = [];
			foreach ($sessions as $session_id => $session)
			{
				if (!in_array($session->evercisegroup_id, $group_ids))
				{
					$group_ids[] = $session->evercisegroup_id;
				}
				$members[$session->id] = count($session->sessionmembers); // Count those members
				
				
			}


	        $groups = Evercisegroup::whereIn('id', $group_ids)
		    ->get();

			foreach ($groups as $key => $group)
			{
				$groupsWithKeys[$group->id] = $group;
			}
	  	}
	  	
  		$view->with('groups', $groupsWithKeys)
	  		 ->with('sessions', $sessions)
	  		 ->with('members', $members);
	}
}