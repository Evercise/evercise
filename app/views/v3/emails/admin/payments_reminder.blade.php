@extends('v3.emails.template')

@section('body')
<p>Hey</p>
<p>You have <span class="blue-text">{{$total}}</span> payment requests pending today</p>
<p>Please click on the following link to go to the admin and process them!</p>
<p>{{ link_to_route('admin.pending_withdrawal', 'Pending Withdrawals') }}</p>

@stop
