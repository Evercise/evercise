@extends('layouts.master')


@section('content')

	<div class="full-width">
		<div class="trainer-dashboard-wrapper">
			<div class="trainer-dashboard-wrapper-left">
				<div  class="user-block-wrap">
					@include('users.user_block')

					
				</div>
				<ul class="dashboard-tab">
					<li data-view="classespast" class="selected">Attended Classes</li>
					<li data-view="classesfuture">Upcoming Classes</li>
					<li data-view="profile" >Edit profile</li>
					<li data-view="password">Change Password</li>
					
					
				</ul>
			</div>

			<div class="dashboard-wrapper-right user-dash">

				<div id="classespast" class="dashboard-block">
					@include('users.classespast')
				</div>
				<div id="classesfuture" class="dashboard-block">
					@include('users.classesfuture')
				</div>

				<div id="profile" class="dashboard-block">
					@include('users.edit_form', array())
				</div>

				<div id="password" class="dashboard-block">
					@include('users.changepassword')
				</div>

				

				
				
			</div>
				
		</div>
	</div>


@stop