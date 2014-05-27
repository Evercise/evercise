@extends('layouts.master')

@section('content')

	@include('trainers.trainerBlock', array('image'=>'/profiles/'.$trainer->directory.'/'.$trainer->image , 'name' => $trainer->display_name))
@stop


