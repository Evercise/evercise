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
		<div class="row12">
			<div class="donut-chart">
				@include('widgets.donutChart', array('label' => 'Total Class Bookings', 'width' => 120 , 'id' => 'total-class-bookings1','total' => $totalCapacity, 'fill' => $totalSessionMembers ))
			</div>
			<div class="donut-chart">
				@include('widgets.donutChart', array('label' => 'Average Class Bookings', 'width' => 120 , 'id' => 'total-class-bookings2','total' => $averageCapacity, 'fill' => $averageSessionMembers ))
			</div>
			<div class="donut-chart">
				@include('widgets.donutChart', array('label' => 'Total Class Revenue', 'width' => 120 , 'id' => 'total-class-bookings3','total' => 500, 'fill' => 300 ))
			</div>
			<div class="donut-chart">
				@include('widgets.donutChart', array('label' => 'Average Class Bookings', 'width' => 120 , 'id' => 'total-class-bookings4','total' => 500, 'fill' => 300 ))
			</div>
		
		</div>

		<hr class="col12">

		<div class="col12">
			<h3>Class Sessions</h3>
		</div>
		<div class="session-table">
			<li class="hd">Class Date</li>
			<li class="hd">Start Time</li>
			<li class="hd">End Time</li>
			<li class="hd">Price Per Person</li>
			<li class="hd">Places Filled</li>
			<li class="hd">Options</li>
			
			@foreach ($evercisegroup['Evercisesession'] as $key => $value) 
				<ul>
					<div class="session-list-row">
						<li>{{ date('M-dS' , strtotime($value['date_time'])) }}</li>
						<li>{{ date('h:ia' , strtotime($value['date_time'])) }}</li>
						<li>{{ date('h:ia' , strtotime($value['date_time']) + ( $value['duration'] * 60)) }}</li>
						<li>&pound;{{ $value['price'] }}</li>
						<li> <strong>{{$value['members']}}</strong>/{{ $evercisegroup->capacity }} </li>
						<li>
							{{ HTML::decode(HTML::linkRoute('sessions.mail_all', '<img src="/img/mail_icon.png"></img>', array('id'=>$value['id']), array('class'=>'mail_all session-icon')) ) }}
							{{ Form::open(array('id' => 'download_members', 'url' => 'postPdf', 'method' => 'post', 'class' => '')) }}
								{{ Form::hidden( 'postMembers' , $value['Sessionmembers'] , array('id' => 'postMembers')) }}
								<button type="submit">
									{{ HTML::image('/img/download_icon.png', 'mail icon' , array('class' => 'session-icon')); }}
								</button>
								 
							{{ Form::close() }}
							
							{{ HTML::image('/img/view_icon.png', 'mail icon' , array('id'=> 'view-session' ,'class' => 'session-icon session-icon-view')); }} 
						</li>
					</div>
					
					<div class="session-members-list">

						@foreach($value['Sessionmembers'] as $k => $val)

							@if ($k % 3 === 2) 
								</div>
							@endif
							@if ($k % 2 === 0) 
								<div class="session-members-row">
							@endif
							<div class="session-members-col">
								{{ HTML::image('profiles/'.$val['Users']['directory'].'/'.$val['Users']['image'], 'session members profile image' , array('class' => 'session-list-profile')); }}
								<div class="session-list-info">
									<p>{{ $val['Users']['display_name'] }}</p>
									<p>Joined on the {{ date('dS-M', strtotime($val['created_at']) )  }}</p>

								</div>
								{{ HTML::image('/img/mail_icon.png', 'mail icon' , array('class' => 'session-icon')); }}
								
							</div>
						@endforeach
						@if(! $value['Sessionmembers']->isEmpty())
							</div>
							
						@endif

						<div class="session-members-footer">
							<aside>
								<a href="">
								{{ HTML::image('/img/mail_icon.png', 'mail icon' , array('class' => 'session-icon')); }}
									Message All Users
								</a>
							</aside>
							<aside>
								{{ Form::open(array('id' => 'download_members', 'url' => 'postPdf', 'method' => 'post', 'class' => '')) }}
									{{ Form::hidden( 'postMembers' , $value['Sessionmembers'] , array('id' => 'postMembers')) }}
									<button type="submit">
										{{ HTML::image('/img/download_icon.png', 'mail icon' , array('class' => 'session-icon')); }}
										<span>Download List</span>
									</button>
									 
								{{ Form::close() }}
							</aside>
							
						</div>
					</div>
				</ul>
			@endforeach
		</div>
		
	

	</div>






@stop