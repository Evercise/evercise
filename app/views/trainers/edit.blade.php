@extends('layouts.master')


@section('content')

	
	@include('trainers.trainerBlock', array('orientation' => 'landscape'))
	<div class="full-width">
		<div class="trainer-dashboard-wrapper">
			<div class="trainer-dashboard-wrapper-left">
				<ul>
					<li data-view="profile" class="selected">Edit profile</li>
					<li data-view="trainer">Edit trainer details</li>
				</ul>
			</div>

			<div class="trainer-dashboard-wrapper-right">
				<div id="profile" class="dashboard-block">
					<div class="dashboard-header"><h3>Profile</h3></div>
					@include('users.edit_form', array())
				</div>

				<div id="trainer" class="dashboard-block">
					<div class="dashboard-header"><h3>Trainer</h3></div>
					@include('trainers.editForm')
				</div>
				
				
			</div>
				
		</div>
	</div>


@stop