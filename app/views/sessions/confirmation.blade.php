@extends('layouts.master')


@section('content')
	<div  class="full-width">
		<div class="col3">
			@include('layouts.classBlock', array('evercisegroupId' => $evercisegroup->id,'title' => $evercisegroup->name , 'description' =>$evercisegroup->description ,  'image' => 'profiles/'.$userTrainer->directory .'/'. $evercisegroup->image,  'default_price' => $evercisegroup->default_price, 'default_size' => $evercisegroup->capacity ))
				
		</div>
		<div class="col9">
			<h1>Thank you!</h1>
			<h5>This is to confirm that you have successfully purchased a place on the following class:<br>	
			{{$evercisegroup->name}} </h5>
			<br>
			<span>We have sent you an e-mail to confirm your purchase. We will also send you a reminder e-mail the day before the class.</span>

			<hr>
			<h5>Please find a break down below</h5>
			<br>

			<div class="session-table">
				<li class="hd">Class Date</li>
				<li class="hd">Start Time</li>
				<li class="hd">End Time</li>
				<li class="hd">Price <small>(Per Person)</small></li>
				<li class="hd">No. Joined</li>
				<li class="hd"></li>
				<ul>
					@foreach ($evercisegroup->evercisesession as $key => $value)
							<div class="session-list-row">
								<li>{{ date('M-dS' , strtotime($value['date_time'])) }}</li>
								<li>{{ date('h:ia' , strtotime($value['date_time'])) }}</li>
								<li>{{ date('h:ia' , strtotime($value['date_time']) + ( $value['duration'] * 60))}}
								<li>&pound;{{ $value['price'] }}</li>
								<li> <strong>
								{{$members[$key] ? $members[$key] : 0}}
								</strong>/{{ $evercisegroup->capacity }} </li>
								<li></li>
							</div>
					@endforeach
				</ul>
				<div class="session-total">
					{{ HTML::link('evercisegroups/'. $evercisegroup->id, 'class page' , ['class' => 'btn btn-yellow']); }}
				</div>
			</div>
		</div>
		

	</div>
@stop