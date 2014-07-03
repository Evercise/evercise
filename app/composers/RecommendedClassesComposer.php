<?php
 
class RecommendedClassesComposer {

	public function compose($view)
  	{
  		$evercisegroups = Evercisegroup::has('futuresessions')
  				->with('user')
          ->has('confirmed')
          ->with('ratings')
  				/*->with(['ratings' => function($query){
              $query->select('stars');
          }])*/
  				->orderBy(DB::raw('RAND()'))->take(4)->get();		

  		$ratings = [];
  		

  		foreach ($evercisegroups as $key => $evercisegroup) {
        $stars = 0;
      
  			if (count($evercisegroup->ratings) == 0 ) {
  				$ratings[$rating->evercisegroup_id] = 0;
  			}else{
  				foreach ($evercisegroup->ratings as $k => $rating) {
	  				$ratings[$rating->evercisegroup_id] = $stars + $rating->stars;
	  				$stars = $stars + $rating->stars;
	  			}
         
  			}
 
  			
  			
  		}

  		$view->with('evercisegroups', $evercisegroups)
  			 ->with('ratings', $ratings);
  	}
}