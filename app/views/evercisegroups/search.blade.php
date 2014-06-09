@extends('layouts.master')

@section('content' )

	@include('evercisegroups.discover', array('places' => $places))

@stop