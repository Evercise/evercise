@extends('v3.emails.template')

@section('body')

<p>Hi {{ $trainer->first_name }},</p>
<br>
<p>You’ve received a new message through Evercise from {{$user->first_name}}, who will be taking part in your class {{ $evercisegroup->name }}.</p>
<br>
<p>Please see the message below:</p>
<br>
<p><strong>{{ $messageSubject }}</strong></p>
<br>
<p>{{ $messageBody }}</p>

<p>
To Reply to this message please contact the user directly at {{$user->email}}
</p>



@stop