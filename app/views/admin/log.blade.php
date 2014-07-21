@extends('layouts.master')

@section('content')
	<div class="full-width">
	{{ Form::open(array('id' => 'search-by-location', 'url' => 'admin/log', 'method' => 'post', 'class' => 'search-form')) }}
	{{ Form::hidden( 'del' , 'delete_all') }}
	{{ Form::submit('Delete' , array('class'=>'btn btn-red ')) }}
	{{ Form::close() }}
	<br>
	<p>
	{{ $log }}
	</p>
	</div>
@stop