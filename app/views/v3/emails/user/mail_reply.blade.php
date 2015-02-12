@extends('v3.emails.template')

@section('body')

<p>Hi <span class="blue-text">{{ $recipient->first_name }}</span>,</p>

<p>You&apos;ve received a new message through Evercise from {{$sender->first_name}}.</p>
<p>Please see the message below:</p>
<br>
<p>{{ $messageBody }}</p>
<br>
<p>

{{ Html::decode(Html::linkRoute('conversation', 'To Reply to this message please click here', [$sender->display_name], ['class' => ''])) }}
</p>



@stop