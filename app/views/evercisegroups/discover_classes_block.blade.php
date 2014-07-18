<div class="row9">
	@if (isset($evercisegroups)) 
		@foreach ($evercisegroups as $key => $evercisegroup) 
			<?php
				 $sentryUserGroup = Sentry::findUserById($evercisegroup->user->id);
				 $sentryUser = Sentry::getUser();
				 $testers = Sentry::findGroupById(5);

				 $testerLoggedIn = false;
				 if($sentryUser) $testerLoggedIn = $sentryUser->inGroup($testers);

			 ?>
			 @if (!$sentryUserGroup->inGroup($testers) || $testerLoggedIn)
				<div class="col3">
				
						@include('layouts.classBlock', array( 'rating' => isset($stars[$evercisegroup->id])?  array_sum($stars[$evercisegroup->id])/ count($stars[$evercisegroup->id]) : 0 ,  'evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$evercisegroup->user->directory .'/'. $evercisegroup->image, 'category' => $evercisegroup->category->name , 'venue' => $evercisegroup->venue  , 'sessions' => $evercisegroup->futuresessions,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
				</div>
			@endif

		@endforeach
	@endif
</div>

