@extends('v3.emails.template')

@section('body')

<h3>Hey <span class="pink-text">{{$user->display_name}}</span></h3>
<br>
<br>
<p>We just wanted to thank you for your review.</p>
<p>Sharing is an important part of the Evercise community and reviews are a great way to enhance everyone’s Evericse experience.</p>
<p>We love to hear what you think and we reckon your friends would too. Sharing your Evercise experience on social media is quick and easy, just click on the link below.</p>

<p>Share this class on:</p>
<a class="blue-text" href="{{ Share::load(URL::to('class/'.$group->slug)  , $group->name)->facebook()  }}" target="_blank">{{image('/assets/img/email/btns/btn_fb.png', 'Facebook', ['class'=>'img-original'])}}</a>
<a class="blue-text" href="{{ Share::load(URL::to('class/'.$group->slug)  , $group->name)->twitter()  }}" target="_blank">{{image('/assets/img/email/btns/btn_twitter.png', 'Twitter', ['class'=>'img-original'])}}</a>
<a class="blue-text" href="{{ Share::load(URL::to('class/'.$group->slug)  , $group->name)->gplus()  }}" target="_blank">{{image('/assets/img/email/btns/btn_gplus.png', 'Google+', ['class'=>'img-original'])}}</a>

@stop
