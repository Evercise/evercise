@extends('layouts.master')


@section('content')

<div  class="full-width">
	<div class="full-bk" style="background-image: url(/profiles/{{$trainer->directory}}/{{$evercisegroup->image}})">
	</div>
	<div id="class-trainer-wrapper">
	{{ var_dump($trainer->Trainer) }}

		@include('trainers.trainerBlock', array('orientation' => 'portrait', 'image' => '/profiles/'.  $trainer->directory.'/'. $trainer->image , 'name' => $trainer->display_name , 'member_since' => date('dS M-Y', strtotime( $trainer->created_at))))
	</div>
</div>

@stop