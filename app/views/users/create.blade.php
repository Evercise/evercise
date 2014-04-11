@extends('layouts.master')

{{ HTML::script('js/less.js'); }}
{{ HTML::style('style/style.less'); }}

@section('content')

	<p>user.create body content</p>
	{{ Form::open(array('url' => 'users', 'method' => 'post')) }}
    	{{ Form::text('userName', '', array('placeholder' => 'place held', 'maxlength' => 20), Input::old('userName'))}}
    	@if ($errors->has('userName'))
    		{{ $errors->first('userName')}}
    	@endif
    	{{ Form::submit('send it') }}
	{{ Form::close() }}
@stop

