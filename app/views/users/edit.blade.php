@extends('layouts.master')


@section('content')

	<div class="full-width">
		<div class="trainer-dashboard-wrapper">
			<div class="trainer-dashboard-wrapper-left">
				<ul>
					<li data-view="profile" class="selected">Edit profile</li>
					<li data-view="password">Change Password</li>
					<li data-view="history">History Stats</li>
				</ul>
			</div>

			<div class="trainer-dashboard-wrapper-right">
				<div id="profile" class="dashboard-block">
					<div class="dashboard-header"><h3>Profile</h3></div>
					@include('users.edit_form', array())
				</div>

				<div id="password" class="dashboard-block">
					<div class="dashboard-header"><h3>Password</h3></div>
					@include('users.changepassword')
				</div>

				<div id="history" class="dashboard-block">
					<div class="dashboard-header"><h3>History Stats</h3></div>
					@include('users.history')
				</div>
				
				
			</div>
				
		</div>
	</div>


@stop