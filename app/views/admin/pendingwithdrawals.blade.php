@extends('layouts.master')

@section('content')
	<div class="full-width">
		<table class="admin_table">
			<tr>
				<th>User Link</th>
				<th>Display Name</th>
				<th>Email Address</th>
				<th>Bio</th>
				<th>Approval</th>
			</tr>
			@foreach($trainers as $key => $trainer)
				<tr>
					<td><a href="{{ URL::route('trainers.show', $trainer->user->id) }}" >{{ HTML::image('profiles/'.$trainer->user->directory.'/'.$trainer->user->image, 'trainers image', array('class'=> 'trainer-block-image'))}}</a></td>
					<td>{{ $trainer->user->display_name }}</td>
					<td>{{ $trainer->user->email }}</td>
					<td>{{ $trainer->bio }}</td>
					<td>
					{{ Form::open(array('id' => 'approve'.$key, 'url' => 'admin/approve_trainer', 'method' => 'post', 'class' => '')) }}

						{{ Form::hidden( 'trainer' , $trainer->id, array('id' => 'trainer')) }}

						{{ Form::submit('Approval' , array('class'=>'btn-yellow ')) }}

					{{ Form::close() }}


					</td>
				</tr>
			@endforeach
			
		</table>
	</div>
@stop