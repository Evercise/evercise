@extends('layouts.master')


@section('content')
    {{ Form::open(['id' => 'upload', 'url' => 'image/upload', 'files' => true, 'method' => 'post']) }}
        {{ Form::file('image', array('id'=>'image')) }}
        
    {{ Form::close() }}
@stop