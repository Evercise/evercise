@extends('layouts.master')


@section('content')

	<p>user.create body content</p>
	{{ Form::open(array('url' => 'users', 'method' => 'post')) }}
    	{{ Form::text('userName', '', array('placeholder' => 'place held', 'maxlength' => 20), Input::old('userName'))}}
    	@if ($errors->has('userName'))
    		{{ $errors->first('userName')}}
    	@endif
    	drink some tea
    	{{ Form::submit('send it') }}
	{{ Form::close() }}
@stop

