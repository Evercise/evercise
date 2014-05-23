@extends('layouts.master')

@section('content')

@include('layouts.pagetitle', array('title'=> $evercisegroup->name.'&apos;s attendance list', 'subtitle'=>'view, download  or message your attendance list'))

<div class="col3">
	@include('layouts.classBlock', array('title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$directory .'/'. $evercisegroup->image,   'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity, 'evercisegroupId' => $evercisegroup->id  ))
</div>
<div class="col9">

	@foreach ($evercisegroup['Evercisesession'] as $key => $value) 

		<div class="session-view-header">
			<h5>{{ date('dS F Y' , strtotime($value['date_time'])) }}</h5>
			<br>
			<h6>Start time: {{  date('H:ia' , strtotime($value['date_time'])) }}</h6>
			<h6>End time: {{  date('H:ia' , strtotime($value['date_time']) + ( $value['duration'] * 60)) }}</h6>
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