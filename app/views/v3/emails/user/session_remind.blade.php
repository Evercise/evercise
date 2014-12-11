@extends('v3.emails.template')


@section('body')


<p>Hey {{$name}}</p>
<p>Don&apos;t forget your upcoming class!</p>

<p>{{ $group }}</p>
<p>{{ $dateTime }}</p>
<p>{{ $location }}</p>
<p>{{ $trainerName }}</p>
<p>{{ $trainerEmail }}</p>
<p>Transaction ID: {{ $transactionId }}</p>

<p>Take note of your unique booking code. Your trainer will need this - along with another form of ID - to identify you.</p>
<p>Please try to arrive 15 minutes before the specified start time. Late arrivals can be rejected.</p>
<p>Remember to bring a water bottle, a towel or two and appropriate clothing.</p>
<p>If you have any questions, feel free to contact the instructor <a href="{{route('class.show', [Evercisegroup::getSlug($classId)])}}" target="_blank">here</a>.</p>
<p>Have fun!</p>
<p>Fitness is even more fun with friends! Click on the links below to share this class.</p>


<a href="{{ Share::load(Request::url() , $group)->facebook()  }}" target="_blank"><span class="icon icon-fb-white mr20 hover"></span> </a>
<a href="{{ Share::load(Request::url() , $group)->twitter()  }}" target="_blank"><span class="icon icon-twitter-white mr20 hover"></span> </a>
<a href="{{ Share::load(Request::url() , $group)->gplus()  }}" target="_blank"><span class="icon icon-google-white hover"></span> </a>

@stop