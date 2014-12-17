@extends('v3.emails.template')



@section('body')

<p>Congratulations!</p>
<p>you&apos;ve created your first Evercise class!</p>
<p>Now you&apos;re up and running we&apos;ll keep you up to speed by sending you an email every time your class gets a booking.</p>
<p>You can add further classes and monitor your bookings by regularly visiting your Trainer Class page. Click on the link below to take a look.</p>

{{ Html::decode(Html::linkRoute('class.show', image('/assets/img/email/btns/btn_get_started.png', 'Manage your class'), [$class->slug], ['class' => 'btn btn-blue'])) }}

<p>We&apos;ll make sure your class gets excellent exposure across the Evercise community. Why not give it an extra boost by sharing it with your friends and contacts? Evercise makes it easy to share your classes, just click on the link below to get started.</p>

<p>Share you class on FACEBOOK, TWITTER, GOOGLE PLUS:</p>
<p><a class="blue-text" href="{{ Share::load(URL::to('class/'.$class->slug)  , $class->name)->facebook()  }}" target="_blank">Facebook</a></p>
<p><a class="blue-text" href="{{ Share::load(URL::to('class/'.$class->slug)  , $class->name)->twitter()  }}" target="_blank">Twitter</a></p>
<p><a class="blue-text" href="{{ Share::load(URL::to('class/'.$class->slug)  , $class->name)->gplus()  }}" target="_blank">Google Plus</a></p>

@stop