@extends('layouts.master')

@section('content')

	<div class="full-width">
		<div id="class-info-image" class="full-width-one-q">
			<div class="class-thumb">
				<div class="class-thumb-wrap">
					{{ HTML::image('/profiles/'.$directory .'/'. $evercisegroup->image, 'class image' , array('class' => 'class-thumb-img')); }}
				</div>
			</div>					
		</div>
		<div id="class-info" class="full-width-three-q">
			<h3>{{ $evercisegroup->name }}</h3>
			<p>{{ $evercisegroup->description }}</p>
		</div>
		<hr class="col12">

		<!-- chart s to diaplsy members info when done -->

		@include('widgets.donutChart', array('id' => 'total-class-bookings1','total' => 500, 'fill' => 300 ))
		@include('widgets.donutChart', array('id' => 'total-class-bookings2','total' => 500, 'fill' => 300 ))
		@include('widgets.donutChart', array('id' => 'total-class-bookings3','total' => 500, 'fill' => 300 ))
		@include('widgets.donutChart', array('id' => 'total-class-bookings4','total' => 500, 'fill' => 300 ))
		

		
			

		</div>
	@foreach ($evercisegroup['Evercisesession'] as $key => $value) 

		<div class="session-view-header">
			<h5>{{ date('dS F Y' , strtotime($value['date_time'])) }}</h5>
			<br>
			<h6>Start time: {{  date('h:ia' , strtotime($value['date_time'])) }}</h6>
			<h6>End time: {{  date('h:ia' , strtotime($value['date_time']) + ( $value['duration'] * 60)) }}</h6>
			@include('layouts.progressbar', array('cap' => $evercisegroup->capacity, 'mem' =>$value['members']))
			{{ Form::open(array('id' => 'download_members', 'url' => 'postPdf', 'method' => 'post', 'class' => '')) }}
				{{ Form::hidden( 'postMembers' , $value['Sessionmembers'] , array('id' => 'postMembers')) }}

				{{ Form::submit('Download' , array('class'=>'btn-yellow ')) }}

			{{ Form::close() }}
			<br>
			@foreach($value['Sessionmembers'] as $k => $val)
				<p>{{ $val['created_at']}}</p>
				
				{{ HTML::image('profiles/'.$val['Users']['directory'].'/'.$val['Users']['image'], 'session members profile image' , array('class' => 'session-list-profile')); }}
				<p>{{ $val['Users']['display_name'] }}</p>
				<p>{{ $val['Users']['first_name'] }}</p>
				<p>{{ $val['Users']['last_name'] }}</p>


			@endforeach

			
			<br>
		</div>
		
	@endforeach

	</div>






@stop