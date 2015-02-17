@extends('v3.emails.template')



@section('body')
<p>Hi {{ $user->first_name }}</p>
<p>Thank you for funding your Evercise wallet.</p>
<p>You will find a copy of the transaction below.</p>
<p>Please keep this in a safe place for future reference.</p>
<p><strong>Username: <span class="blue-text">{{ $user->display_name }}</span></strong></p>
<p><strong>Full name: <span class="blue-text">{{ $user->first_name . ' ' . $user->last_name }}</span></strong></p>
<p><strong>Charge method: <span class="blue-text">{{ $transaction->payment_method }}</span></strong></p>
<p><strong>Date charged: <span class="blue-text">{{ $transaction->formattedDate() }}</span></strong></p>
<p><strong>Transaction ID: <span class="blue-text">{{ $transaction->id }}</span></strong></p>
<p><strong>Funding amount: <span class="blue-text">&pound;{{abs($transaction->total_after_fees)}}</span></strong></p>
<p><strong>Wallet balance after funding: <span class="blue-text">&pound;{{$balance}}</span></strong></p>
@stop
