@extends('v3.emails.template')

@section('body')

<p>Hi <span class="blue-text">{{ $trainer->first_name }}</span>,</p>

<p>You&apos;ve received a new message through Evercise from {{$user->first_name}},</p>
<p>Regarding your {{ $evercisegroup->name }} class on the {{date('M jS, g:ia', strtotime($session->date_time )) }}</p>
<p>Please see the message below:</p>
<br>
<p><strong class="blue-text">{{ $messageSubject }}</strong></p>
<p>{{ $messageBody }}</p>
<br>
<p>
To Reply to this message please contact the user directly at {{$user->email}}
</p>



@stop