@extends('v3.emails.template')

@section('body')

<h3>Hey <span class="pink-text">{{$referrerName}}</span></h3>
<br>
<br>
<p>Thanks for referring <span class="pink-text">{{$email}}</span>!</p>
<p>As soon as they sign up we&apos;ll update your Evercise account with a <span class="pink-text">&pound;{{Config::get('values')['milestones']['referral']['reward']}}</span> reward, giving you <span class="pink-text">&pound;{{$balanceWithBonus}}</span> available to book new classes.</p>

@stop
