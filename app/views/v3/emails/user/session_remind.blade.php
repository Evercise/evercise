@extends('v3.emails.template')


@section('body')

<p>Hey <span class="blue-text">{{$name}}</span></p>

<p>Don&apos;t forget your upcoming class <span class="blue-text">{{ $group->name }}</span> is coming up on the <span class="blue-text">{{ date('M jS, g:ia', strtotime($dateTime)) }}</span></p>
<p>This class is held by <span class="blue-text">{{ $trainerName }}</span> </p>
<p>Your transaction ID: <strong class="blue-text">{{ $transactionId }}</strong></p>

@foreach($bookingCodes as $code)
    <p> - Code: <strong class="blue-text">{{ $code }}</strong></p>
@endforeach

<p>Location: <strong class="blue-text">{{ $location }}</strong></p>

<p>Take note of your unique booking code. Your trainer will need this - along with another form of ID - to identify you.</p>
<p>Please try to arrive 15 minutes before the specified start time. Late arrivals can be rejected.</p>
<p>Remember to bring a water bottle, a towel or two and appropriate clothing.</p>
<p>If you have any questions, feel free to contact the instructor <a class="blue-text" href="{{route('users.edit', [$name, 'upcoming'])}}" target="_blank">here</a>.</p>
<p>Have fun!</p>
<p>Fitness is even more fun with friends! Click on the links below to share this class.</p>


<p>Share this class on</p>
<a class="blue-text" href="{{ Share::load(URL::to('class/'.$group->slug)  , $group->name)->facebook()  }}" target="_blank">{{image('/assets/img/email/btns/btn_fb.png')}}</a>
<a class="blue-text" href="{{ Share::load(URL::to('class/'.$group->slug)  , $group->name)->twitter()  }}" target="_blank">{{image('/assets/img/email/btns/btn_twitter.png')}}</a>
<a class="blue-text" href="{{ Share::load(URL::to('class/'.$group->slug)  , $group->name)->gplus()  }}" target="_blank">{{image('/assets/img/email/btns/btn_gplus.png')}}</a>
@stop