@extends('v3.emails.template')

@section('body')
    <strong>Hey <span class="pink-text">{{$user->first_name}}</span></strong>
    <p>We thought you&apos;d like to know that <span class="pink-text">Evercise</span> has just launched a brand spanking <span class="pink-text">new website.</span></p>
    <p>What&apos;s new? Pretty much everything!</p>
    <p>Our <span class="pink-text">newly designed</span> website not only looks better, it&apos;s also much easier to use. We&apos;ve transformed our <span class="pink-text">class management system</span>, making it much easier to list your classes and manage your account.</p>
    <p>We also have a massive post-Christmas campaign planned. With big PPC, Paid Social, PR and affiliate programs planned we&apos;re all set to make a huge impact in 2015.  Get involved today to take full advantage our multi-channel marketing push.</p>
    <p>The <span class="pink-text">Evercise</span> community of instructors, studios and gyms has grown by 800 in just 6 months and we&apos;re confident this is just the start.</p>
    <p>2015 is set to be a big year for <span class="pink-text">Evercise</span>. We want it to be a big year for you <span class="pink-text">too</span>.</p>
@stop

