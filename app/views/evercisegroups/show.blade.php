@extends('layouts.master')


@section('content')

<div  class="full-width">
	<div class="full-bk" style="background-image: url(/profiles/{{$userTrainer->directory}}/{{$evercisegroup->image}})">
	</div>
	<div id="class-trainer-wrapper" class="col3">

		@include('trainers.trainerBlock', array('orientation' => 'portrait', 'image' => '/profiles/'.  $userTrainer->directory.'/'. $userTrainer->image , 'name' => $userTrainer->display_name , 'member_since' => date('dS M-Y', strtotime( $userTrainer->created_at))))
	</div>
	<div class="col9">
		<ul class="class-nav">
			<li>Description</li>
			<li>Sessions</li>
			<li>Venues</li>
			<li>Reviews/Participants</li>
		</ul>
	</div>
</div>

@stop