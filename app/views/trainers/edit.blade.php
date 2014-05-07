@extends('layouts.master')


@section('content')

	<div>Edit trainer (dashboard)</div>
	<h1>{{{ isset($displayName) ? $displayName : "No Name Set" }}}</h1>

@stop