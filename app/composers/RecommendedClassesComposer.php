<?php
 
class RecommendedClassesComposer {

	public function compose($view)
  	{
  		$evercisegroups = Evercisegroup::has('futuresessions')
  				->with('user')
  				->with('ratings')
  				->orderBy(DB::raw('RAND()'))->take(4)->get();		

  		$ratings = [];
  		$stars = 0;

  		foreach ($evercisegroups as $key => $evercisegroup) {
  			if (count($evercisegroup->ratings) == 0 ) {
  				$ratings[] = 0;
  			}else{
  				foreach ($evercisegroup->ratings as $k => $rating) {
	  				$ratings[$key] = $stars + $rating->stars;
	  				$stars = $stars + $rating->stars;
	  			}
  			}

  			
  			
  		}
  		$view->with('evercisegroups', $evercisegroups)
  			 ->with('ratings', $ratings);
  	}
}