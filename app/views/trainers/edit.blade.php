@extends('layouts.master')
<?php

  //set headers to NOT cache a page
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

?>

@section('content')

	@include('trainers.trainerBlock', ['logout' => true , 'speciality' => $trainer->profession , 'orientation' => 'landscape', 'image' => '/profiles/'.  $user->directory.'/'. $user->image , 'name' => $user->display_name , 'member_since' => date('dS M-Y', strtotime( $user->created_at))])

	<div class="full-width">
		<div class="trainer-dashboard-wrapper">
			<div class="trainer-dashboard-wrapper-left">
				@include('trainers.dashboardTabs')
				
			</div>

			<div class="dashboard-wrapper-right">
				<div id="activity" class="dashboard-block">
					<div class="dashboard-header"><h3>Activity</h3></div>
					@include('trainers.trainerHistory')
				</div>

				<div id="wallet" class="dashboard-block">
					<div class="dashboard-header"><h3>My Wallet</h3></div>
					@include('wallets.show')
				</div>

				<div id="trainer" class="dashboard-block">
					<div class="dashboard-header"><h3>Trainer</h3></div>
					@include('trainers.editForm', array('bio' => $trainer->bio))
				</div>

				<div id="profile" class="dashboard-block">
					<div class="dashboard-header"><h3>Profile</h3></div>
					@include('users.edit_form', array())
				</div>

				

				<div id="password" class="dashboard-block">
					<div class="dashboard-header"><h3>Password</h3></div>
					@include('users.changepassword')
				</div>
				
				<div id="evercoins" class="dashboard-block">
					<div class="dashboard-header"><h3>Evercoins</h3></div>
					@include('evercoins.show')
				</div>				

				<div id="classespast" class="dashboard-block">
					<div class="dashboard-header"><h3>Attended Classes {{ !empty($pastFutureCount) ? '('.$pastFutureCount['past'].')' : '' }}</h3></div>
					@include('users.classespast')
				</div>

				<div id="classesfuture" class="dashboard-block">
					<div class="dashboard-header"><h3>Upcoming Classes {{ !empty($pastFutureCount) ? '('.$pastFutureCount['future'].')' : '' }}</h3></div>
					@include('users.classesfuture')
				</div>

				
				
				
			</div>
				
		</div>
	</div>


@stop