@extends('layouts.master')


@section('content')

	<p>user.create body content</p>
	{{ Form::open(array('url' => 'users', 'method' => 'post')) }}
    	@include('form.textfield', array('fieldname'=>'userName', 'placeholder'=>'Choose a username', 'maxlength'=>20))
    	@include('form.textfield', array('fieldname'=>'userPassword', 'placeholder'=>'Choose a password', 'maxlength'=>20))
    	@include('form.select', array('fieldname'=>'userSex'))
    	@if ($errors->has('userName'))
    		{{ $errors->first('userName')}}
    	@endif
<<<<<<< HEAD
=======

>>>>>>> 12f509378abea6b1318667b6938161f748cd7821
    	{{ Form::submit('send it') }}
	{{ Form::close() }}
@stop
