@extends('layouts.master')


@section('content')

@include('layouts.pagetitle', array('title'=>'Edit Venue', 'subtitle'=>'yeah dude'))
<div class="full-width">
    <div class="col10 push1">

	{{ Form::open(array('id' => 'venue_create', 'url' => 'venues/'.$venue->id, 'method' => 'PUT', 'class' => 'create-form')) }}

		@include('venues.edit_form');
		
	{{ Form::close() }}
	</div>
</div>
@stop

