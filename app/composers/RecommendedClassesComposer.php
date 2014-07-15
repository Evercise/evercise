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