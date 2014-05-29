@extends('layouts.master')


@section('content')

	
	@include('trainers.trainerBlock', array('orientation' => 'landscape'))
	<div class="trainer-dashboard-wrapper">
		<div class="trainer-dashboard-wrapper-left">
			<ul>
				<li>Edit profile</li>
			</ul>
		</div>

		<div class="trainer-dashboard-wrapper-right">
			whomp
		</div>
			
	</div>


@stop