@extends('v3.emails.template')

@section('body')

<h3>Hey <span class="pink-text">{{$user->display_name}}</span></h3>
<br>
<br>
<p>We just wanted to thank you for your review.</p>
<p>Sharing is an important part of the Evercise community and reviews are a great way to enhance everyone’s Evericse experience.</p>
<p>We love to hear what you think and we reckon your friends would too. Sharing your Evercise experience on social media is quick and easy, just click on the link below.</p>

<a href="{{ Share::load(Request::url() , $group)->facebook()  }}" target="_blank"><span class="icon icon-fb-white mr20 hover">Facebook</span> </a>
<a href="{{ Share::load(Request::url() , $group)->twitter()  }}" target="_blank"><span class="icon icon-twitter-white mr20 hover">Twitter</span> </a>
<a href="{{ Share::load(Request::url() , $group)->gplus()  }}" target="_blank"><span class="icon icon-google-white hover"></span>Google Plus</a>

@stop
