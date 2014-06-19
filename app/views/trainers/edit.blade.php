@extends('layouts.master')


@section('content')

	@include('trainers.trainerBlock', array('orientation' => 'landscape', 'image' => '/profiles/'.  $user->directory.'/'. $user->image , 'name' => $user->display_name , 'member_since' => date('dS M-Y', strtotime( $user->created_at))))
	<div class="full-width">
		<div class="trainer-dashboard-wrapper">
			<div class="trainer-dashboard-wrapper-left">
				<ul class="dashboard-tab">
					<li data-view="activity" class="selected">View Activity</li>
					<li data-view="profile" >Edit profile</li>
					<li data-view="trainer">Edit trainer details</li>
					<li data-view="password">Change Password</li>
					<li data-view="wallet">View Wallet</li>
				{{--	<li data-view="upcoming">Upcoming Sessions</li> --}}
				</ul>
			</div>

			<div class="dashboard-wrapper-right">
				<div id="activity" class="dashboard-block">
					<div class="dashboard-header"><h3>Activity</h3></div>
					@include('trainers.trainerHistory')
				</div>
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
				<div id="wallet" class="dashboard-block">
					<div class="dashboard-header"><h3>Wallet</h3></div>
					@include('wallets.show')
				</div>

				<div id="upcoming" class="dashboard-block">		
					@include('trainers.upcoming')
				</div>
				
				
			</div>
				
		</div>
	</div>


@stop