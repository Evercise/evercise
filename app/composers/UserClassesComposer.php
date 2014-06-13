<?php
 
class UserClassesComposer {

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
	    $sessionmember_ids = []; // For rating
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
				foreach ($session->sessionmembers as $sessionmember) {
					if($sessionmember->user_id == $user->id)
						$sessionmember_ids[$session->id] = $sessionmember->id;
				}
				
			}

			$ratings = Rating::whereIn('sessionmember_id', $sessionmember_ids)->get();

			$ratingsWithKeys = [];
			foreach ($ratings as $rating) {
				$ratingsWithKeys[$rating->session_id] = $rating->comment;
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
	  		 ->with('members', $members)
	  		 ->with('sessionmember_ids', $sessionmember_ids)
	  		 ->with('ratings', $ratingsWithKeys);
	}
}