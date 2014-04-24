@extends('layouts.master')


@section('content')

	<div>Edit user (dashboard)</div>
	<h1>{{{ isset($displayName) ? $displayName : "No Name Set" }}}</h1>

@stop