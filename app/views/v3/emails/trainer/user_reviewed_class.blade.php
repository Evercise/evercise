@extends('v3.emails.template')

@section('body')

<h3>Hey <span class="pink-text">{{$trainer->display_name}}</span></h3>
<br>
<br>
<p>A user has reviewed your class</p>

They said:
{{$rating->comment}}


@stop
