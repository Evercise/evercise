<?php
/*
  //set headers to NOT cache a page
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

  */
?>
@extends('layouts.master')


@section('content')

	<div class="full-width">
		<div class="trainer-dashboard-wrapper">
			<div class="trainer-dashboard-wrapper-left">
				<div  class="user-block-wrap">
				<div class="dashboard-user-wrap">
					@include('users.user_block')
					<small>{{ HTML::linkRoute('users.logout', 'Log Out') }}</small>
				</div>
					
					@include('users.dashboardTabs')
					
				</div>
				
				@include('evercisegroups.recommended')
			</div>

			<div class="dashboard-wrapper-right">

				<div id="classesfuture" class="dashboard-block">
					<div class="dashboard-header"><h3>Upcoming Classes {{ !empty($pastFutureCount) ? '('.$pastFutureCount['future'].')' : '' }}</h3></div>
					@include('users.classesfuture')
				</div>
				
				<div id="classespast" class="dashboard-block">
					<div class="dashboard-header"><h3>Attended Classes {{ !empty($pastFutureCount) ? '('.$pastFutureCount['past'].')' : '' }}</h3></div>
					@include('users.classespast')
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

				

				
				
			</div>
				
		</div>
	</div>


@stop