@extends('v3.emails.template')

@section('body')

<p>Hi <span class="blue-text">{{ $user->first_name }}</span>,</p>

<p>You&apos;ve received a new message through Evercise from your trainer {{$evercisegroup->user->first_name}},</p>
<p>Regarding your {{ $evercisegroup->name }} class on the {{date('M jS, g:ia', strtotime($session->date_time )) }}</p>
<p>Please see the message below:</p>
<br>
<p><strong class="blue-text">{{ $messageSubject }}</strong></p>
<p>{{ $messageBody }}</p>
<br>
<p>

{{ Html::decode(Html::linkRoute('conversation', 'To Reply to this message please click here', [$evercisegroup->user->display_name], ['class' => ''])) }}
</p>



@stop