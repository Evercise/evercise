@extends('v3.emails.template')



@section('body')

<strong>Hey <span class="pink-text">{{$trainer->display_name}}</span> </strong>
<p><span class="pink-text">{{$user->display_name}}</span> has joined your class <span class="pink-text">{{$evercisegroup->name}}</span> on the <span class="pink-text">{{$session->date_time}}</span></p>
<p>Their transaction id is: <span class="pink-text">{{Transactions::find($transactionId)->transaction}}</span></p>

@stop