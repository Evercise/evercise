<?php
 
class RecommendedClassesComposer {

	public function compose($view)
  	{
  		$evercisegroups = Evercisegroup::has('futuresessions')
          ->with('user')
          ->with('category')
  				->with('venue')
          ->has('confirmed')
          ->with('ratings')
  				/*->with(['ratings' => function($query){
              $query->select('stars');
          }])*/
  				->orderBy(DB::raw('RAND()'))->take(4)->get();		

  		$ratings = [];

      $testers = Sentry::findGroupById(5);

  		foreach ($evercisegroups as $key => $evercisegroup) {
        $stars = 0;

  				foreach ($evercisegroup->ratings as $k => $rating) {
	  				$ratings[$rating->evercisegroup_id] = $stars + $rating->stars;
	  				$stars = $stars + $rating->stars;
	  			}
          			
          // See if group belongs to a tester
          $sentryUserGroup = Sentry::findUserById($evercisegroup->user->id);
          if ($sentryUserGroup->inGroup($testers))
            if (!($this->user->inGroup($testers)) )
              unset($evercisegroups[$key]);
  			
  		}

  		$view->with('evercisegroups', $evercisegroups)
  			 ->with('ratings', $ratings);
  	}
}