@extends('pdf.master')

@section('content')

	<div class="center_col">
		<h1> whoooooomp</h1>

			@foreach ($data as $key => $value) 
				{{ $value['id']}}

				{{ $value['users']['email']}}

				{{ $value['users']['display_name']}}
					
				{{ HTML::image('profiles/'.$value['users']['directory'].'/'.$value['users']['image'], 'session members profile image' , array('class' => 'session-list-profile')); }}

			@endforeach

	</div>
	


@stop