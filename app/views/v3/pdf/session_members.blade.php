@extends('v3.pdf.master')

@section('content')

	<div class="center_col">
		<h1>{{ $evercisegroup->name }}</h1>
		<h3>{{ date('d-M-Y H:ia', strtotime($evercisesession->date_time)) }}</h3>
		<div class="pdf-table">
			@foreach ($sessionmembers as $key => $user)

				<div class="pdf-row">
					@if($user['image'] != null)

					{{ HTML::image($user->directory.'/medium_'.$user->image, 'session members profile image' , ['class' => 'session-list-profile']); }}
					@endif
					<div class="pdf-wrap">
						<p>User Name: {{ $user['display_name']}}</p>
						<p>User ID: {{ $user['email']}}</p>
						<p>Transaction ID: {{ $user['pivot']['transaction_id']}}</p>
					</div>
					

					
				</div>

			@endforeach
		</div>

			

	</div>
	


@stop
