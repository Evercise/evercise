@extends('pdf.master')

@section('content')

	<div class="center_col">
		<h1>{{ $evercisegroup }}</h1>
		<h3>{{ date('d-M-Y H:ia', strtotime($evercisesession)) }}</h3>

		<div class="pdf-table">
			@foreach ($sessionmembers as $key => $users) 

				<div class="pdf-row">
					@if($users['image'] != null)

					{{ HTML::image('profiles/'.$users['directory'].'/'.$users['image'], 'session members profile image' , array('class' => 'session-list-profile')); }}
					@else
						{{ HTML::image('img/no-user-img.jpg', 'session members profile image' , array('class' => 'session-list-profile')); }}
					@endif
					<div class="pdf-wrap">
						<p>{{ $users['display_name']}}</p>
						<p>{{ $users['email']}}</p>
					</div>
					

					
				</div>

			@endforeach
		</div>

			

	</div>
	


@stop
