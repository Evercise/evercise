@extends('layouts.master')


@section('title', 'View Classes')
@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))

	@foreach($users as $user)
                
                <p{{ $user->inGroup(Sentry::findGroupByName('Trainer')) ? ' style="color:red"' : '' }}>
                {{  $user->id . ' : ' . $user->display_name . ' : ' . $user->email }}</p>
                

		
	@endforeach

@stop