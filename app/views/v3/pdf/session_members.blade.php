@extends('v3.pdf.master')

@section('content')

	<div class="center_col">
		<h1>{{ $evercisegroup->name }}</h1>
		<h3>{{ date('d-M-Y H:ia', strtotime($evercisesession->date_time)) }}</h3>
		<div class="pdf-table">
		<?php $bookingCodes = [] ?>
        @foreach ($sessionmembers as $key => $user)
			@if (! isset($bookingCodes[$user['pivot']['transaction_id'].'_'.$user['pivot']['evercisesession_id']]) )
				<div class="pdf-row">
					@if($user['image'] != null)
						{{ HTML::image($user->directory.'/medium_'.$user->image, 'session members profile image' , ['class' => 'session-list-profile']); }}
					@endif
					<div class="pdf-wrap">
						<p>User Name: {{ $user['display_name']}}</p>
						<?php
							$transaction = \Transactions::where('id', $user['pivot']['transaction_id'])->first();
							$bookingCodes[$user['pivot']['transaction_id'].'_'.$user['pivot']['evercisesession_id']] = $transaction->makeBookingHashBySession($user['pivot']['evercisesession_id']);
							$countCodes = 0;
						?>
						<p>Tickets bought: {{ count($bookingCodes[$user['pivot']['transaction_id'].'_'.$user['pivot']['evercisesession_id']]) }}</p>
						<p>Booking Codes:
						@foreach($bookingCodes[$user['pivot']['transaction_id'].'_'.$user['pivot']['evercisesession_id']] as $code)
						{{ $code . ( $countCodes++ >= count($bookingCodes[$user['pivot']['transaction_id'].'_'.$user['pivot']['evercisesession_id']]) ? '' : ',' ) }}
						@endforeach
						</p>
					</div>
				</div>
			@endif
		@endforeach
		</div>

			

	</div>
	


@stop
