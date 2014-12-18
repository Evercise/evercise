@extends('v3.emails.template')

@section('body')

<h3>Hey <span class="pink-text">{{$trainer->display_name}}</span></h3>
<br>
<br>
<p>A user has reviewed your class</p>

<p>They said:</p>
<p>{{$rating->comment}}</p>


@stop
