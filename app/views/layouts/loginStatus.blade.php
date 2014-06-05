	<a href="{{ URL::route('trainers.show', $user->id ) }}">
		{{ HTML::image( 'profiles/'. $user->directory.'/'.$user->image, $user->display_name.'s image', array('class'=> 'profile-pic')); }}
	</a>
	<li id="displayName" class="float-right">
		{{ $user->display_name }}
	</li>

<div id="displayName-dropdown" class="dropdown-menu">
	@if($group == 'trainer')	
		<span>{{ HTML::linkRoute('trainers.edit', 'My Dashboard' , $user->id) }}</span>
		<span>{{ HTML::linkRoute('evercisegroups.index', 'Class Hub') }}</span>
		<hr>
		<span>{{ HTML::linkRoute('users.logout', 'Log Out') }}</span>
			
	@else
		<span>{{ HTML::linkRoute('users.edit', 'My Dashboard' , $user->id) }}</span>
		<span>{{ HTML::linkRoute('evercisegroups.index', 'My Cart') }}</span> 
		<hr>
		<span>{{ HTML::linkRoute('users.logout', 'Log Out') }}</span>
	@endif
</div>
