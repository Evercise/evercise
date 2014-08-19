<?php
 
class RecommendedClassesComposer {

	public function compose($view)
  	{
      $sentryUser = Sentry::getUser();
      $testers = Sentry::findGroupById(5);
      $testerLoggedIn = $sentryUser ? $sentryUser->inGroup($testers) : false;

  		$evercisegroups = Evercisegroup::has('futuresessions')
          ->whereIn('id', [191, 181, 189,  33])
          ->has('confirmed')
          ->has('tester', '<', $testerLoggedIn ? 5 : 1) // testing to make sure class does not belong to the tester
          ->with('user')
  				->with('venue')
          ->with('ratings')
  				/*->with(['ratings' => function($query){
              $query->select('stars');
          }])*/
  				//->orderBy(DB::raw('RAND()'))
          ->take(4)
          ->get();		

  		$ratings = [];


  		foreach ($evercisegroups as $key => $evercisegroup) {
        $stars = 0;

				foreach ($evercisegroup->ratings as $k => $rating) {
  				$ratings[$rating->evercisegroup_id] = $stars + $rating->stars;
  				$stars = $stars + $rating->stars;
  			}
  		}

  		$view->with('evercisegroups', $evercisegroups)
  			 ->with('ratings', $ratings);
  	}
}