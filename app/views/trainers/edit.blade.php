@extends('layouts.master')


@section('content')

	@include('trainers.trainerBlock', array('orientation' => 'landscape', 'image' => '/profiles/'.  $user->directory.'/'. $user->image , 'name' => $user->display_name , 'member_since' => date('dS M-Y', strtotime( $user->created_at))))
	<div class="full-width">
		<div class="trainer-dashboard-wrapper">
			<div class="trainer-dashboard-wrapper-left">
				<ul>
					<li data-view="profile" class="selected">Edit profile</li>
					<li data-view="trainer">Edit trainer details</li>
					<li data-view="password">Change Password</li>
				</ul>
			</div>

			<div class="trainer-dashboard-wrapper-right">
				<div id="profile" class="dashboard-block">
					<div class="dashboard-header"><h3>Profile</h3></div>
					@include('users.edit_form', array())
				</div>

				<div id="trainer" class="dashboard-block">
					<div class="dashboard-header"><h3>Trainer</h3></div>
					@include('trainers.editForm', array('bio' => $trainer->bio))
				</div>

				<div id="password" class="dashboard-block">
					<div class="dashboard-header"><h3>Password</h3></div>
					@include('users.changepassword')
				</div>
				
				
			</div>
				
		</div>
	</div>


@stop