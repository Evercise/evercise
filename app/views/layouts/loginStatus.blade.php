@if($displayName != 'none')
	<a href="{{ URL::route('trainers.show', $userId ) }}">
		{{ HTML::image( $displayImage, $displayName.'s image', array('class'=> 'profile-pic')); }}
	</a>
	<li id="displayName" class="float-right">
		{{ $displayName }}
	</li>

	<div id="displayName-dropdown" class="dropdown-menu">
		<span>{{ HTML::linkRoute('trainers.edit', 'My Dashboard' , $userId) }}</span>
		<span>{{ HTML::linkRoute('evercisegroups.index', 'Class Hub') }}</span>
		<hr>
		<span>{{ HTML::linkRoute('users.logout', 'Log Out') }}</span>
	</div>
	
	
@else
	<li>{{ HTML::linkRoute('users.create', 'Join Evercise') }}</li>

	@if(isset($redirect_after_login))
		<li>{{ HTML::link('/auth/login/'.Route::getCurrentRoute()->getName() , 'Login',  array('id'=>'login', 'class' => 'login')) }}</li>
	@else
		<li>{{ HTML::linkRoute('auth.login', 'Login', null, array('id'=>'login', 'class' => 'login')) }}</li>
	@endif
@endif
