@extends('layouts.master')


@section('content')
@include('layouts.pagetitle', array('title'=>'Evercise Team', 'subtitle'=>'Meet the brains behind Evercise!'))
    <div id="the-team" class="col10 push1">

    @foreach(trans('the_team') as $team_member)

    <aside>
		{{ HTML::image($team_member['image'], $team_member['name'] , array('class' => 'team-img')); }}
		<h3>{{$team_member['name']}}</h3>
		<h5>{{$team_member['title']}}</h5>
		<div class="team_blurb">
    		<p><strong>Favourite food:</strong>{{$team_member['food']}}</p>
    		<p><strong>Hobby(s):</strong>{{$team_member['hobby']}}</p>
    		<p><strong>Favourite Quote:</strong> <q>{{$team_member['quote']}}</q></p>
		</div>
	</aside>

    @endforeach

    </div>
@stop