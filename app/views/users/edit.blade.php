@extends('layouts.master')


@section('content')

	<div class="full-width">
		<div class="trainer-dashboard-wrapper">
			<div class="trainer-dashboard-wrapper-left">
				<div  class="user-block-wrap">
					@include('users.user_block')
					@include('users.dashboardDropdown')
					
				</div>
				@include('users.dashboardTabs')
			</div>

			<div class="dashboard-wrapper-right user-dash">

				<div id="classespast" class="dashboard-block">
					<div class="dashboard-header"><h3>Attended Classes {{ !empty($pastFutureCount) ? '('.$pastFutureCount['past'].')' : '' }}</h3></div>
					@include('users.classespast')
				</div>
				<div id="classesfuture" class="dashboard-block">
					<div class="dashboard-header"><h3>Upcoming Classes {{ !empty($pastFutureCount) ? '('.$pastFutureCount['future'].')' : '' }}</h3></div>
					@include('users.classesfuture')
				</div>

				<div id="profile" class="dashboard-block">
					<div class="dashboard-header"><h3>Profile</h3></div>
					@include('users.edit_form', array())
				</div>

				<div id="password" class="dashboard-block">
					<div class="dashboard-header"><h3>Password</h3></div>
					@include('users.changepassword')
				</div>

				

				
				
			</div>
				
		</div>
	</div>


@stop