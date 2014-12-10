@extends('v3.emails.template')


@section('body')


<p>Hey {{$name}}</p>
<p>Don&apos;t forget your upcoming class!</p>

<p>{{ $group }}</p>
<p>{{ $dateTime }}</p>
<p>{{ $location }}</p>
<p>{{ $trainerName }}</p>
<p>{{ $trainerEmail }}</p>

<p>Take note of your unique booking code. Your trainer will need this - along with another form of ID - to identify you.</p>
<p>Please try to arrive 15 minutes before the specified start time. Late arrivals can be rejected.</p>
<p>Remember to bring a water bottle, a towel or two and appropriate clothing.</p>
<p>If you have any questions, feel free to contact the instructor here.</p>
<p>Have fun!</p>
<p>Fitness is even more fun with friends! Click on the link below to share this class.</p>


@stop