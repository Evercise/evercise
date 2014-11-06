@extends('layouts.master')


@section('title', 'View Classes')
@section('content')

	@include('layouts.pagetitle', array('title'=>'View Users', 'subtitle'=>'and groups'))

	@foreach($users as $key => $theUser)
                
                <p{{ $sentryUsers[$key]->inGroup(Sentry::findGroupByName('Trainer')) ? ' style="color:red"' : '' }}>
                {{  $theUser->id . ' : ' . $theUser->display_name . ' : ' . $theUser->email }}


                <a href="/admin/logInAsUser/{{$theUser->id}}" target="_blank">Log in as User</a></p>
                @foreach($theUser->evercisegroups as $evercisegroup)
                <ul>
                        <li class="indent" style="color:green"> {{$evercisegroup->name}}</li>
                </ul>
                @endforeach

		
	@endforeach

@stop