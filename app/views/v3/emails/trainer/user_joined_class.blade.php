@extends('v3.emails.template')



@section('body')

<p>Dear {{$trainer->display_name}}</p>
<p>Someone has joined your class (Whoop!)</p>
<p>name of user: {{$user->display_name}}</p>
<p>name of group: {{$evercisegroup->name}}</p>
<p>session: {{$session->date_time}}</p>
<p>transaction id: {{Transactions::find($transactionId)->transaction}}</p>

@stop