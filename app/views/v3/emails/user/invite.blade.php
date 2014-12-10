@extends('v3.emails.template')
<?php View::share('align', 'center') ?>

@section('body')

<p>Welcome to Evercise!</p>
<p>Join {{$referrerName}} and discover Evercise - the flexible new Pay As You Go fitness community that fits in with your lifestyle and doesn&apos;t tie you down to an expensive gym membership.</p>
<p>{{$referrerName}} has already discovered the benefits of Evercise, why not take a look yourself?</p>
<p>Sign up using the link below and we’ll even add £5 to your Evercise balance to get started with.</p>
<p>The Evercise network gives you access to a huge choice of fun and flexible fitness classes wherever you are and our simple three-step process means it’s quick and easy to sign up and get involved.</p>

@stop
@section('extra')

<p>1. SEARCH – Evercise makes it easy to search your area and discover the perfect class for you. With classes covering everything from aerobics to zumba you’re sure to find something nearby that takes your fancy.</p>
<p>2. SELECT – You can see reviews of all our classes, find out more about the venue and facilities and ask the trainer any questions you might have.</p>
<p>3. SIGN UP – When you’ve found a class you like the look of our simple Pay As You Go booking system ensures that joining your class is as quick and easy as ordering a pizza!</p>

@stop