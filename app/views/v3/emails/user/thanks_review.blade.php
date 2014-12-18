@extends('v3.emails.template')

@section('body')

<h3>Hey <span class="pink-text">{{$user->display_name}}</span></h3>
<br>
<br>
<p>We just wanted to thank you for your review.</p>
<p>Sharing is an important part of the Evercise community and reviews are a great way to enhance everyone’s Evericse experience.</p>
<p>We love to hear what you think and we reckon your friends would too. Sharing your Evercise experience on social media is quick and easy, just click on the link below.</p>

<p>Share this class on <a class="pink-text" href="{{ Share::load(Request::url() , $group)->facebook()  }}" target="_blank">Facebook </a></p>
<p>Share this class on <a class="pink-text" href="{{ Share::load(Request::url() , $group)->twitter()  }}" target="_blank">Twitter</a></p>
<p>Share this class on <a class="pink-text" href="{{ Share::load(Request::url() , $group)->gplus()  }}" target="_blank">Google Plus</a></p>

@stop
