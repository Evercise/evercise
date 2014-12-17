@extends('v3.emails.template')



@section('body')

<p>Hi {{ $user->first_name }}</p>

<p>Thank you for funding your Evercise wallet.</p>
<p>You will find a copy of the transaction below.</p>
<p>Please keep this in a safe place for future reference.</p>
@stop
@section('extra')
<table class="table" width="100%" height="20" align="left" cellspacing="30" cellpadding="0" bgcolor="#FFFFFF">
    <tbody>
        <tr>
            <td colspan="7" align="right" >
                <strong>Username: <span class="blue-text">{{ $user->display_name }}</span></strong>
            </td>
        </tr>
        <tr>
            <td colspan="7" align="right" >
                <strong>Full name: <span class="blue-text">{{ $user->first_name . ' ' . $user->last_name }}</span></strong>
            </td>
        </tr>
        <tr>
            <td colspan="7" align="right" >
                <strong>Charge method: <span class="blue-text">{{ $transaction->payment_method }}</span></strong>
            </td>
        </tr>
        <tr>
            <td colspan="7" align="right" >
                <strong>Date charged: <span class="blue-text">{{ $transaction->formattedDate() }}</span></strong>
            </td>
        </tr>
        <tr>
            <td colspan="7" align="right" >
                <strong>Transaction ID: <span class="blue-text">{{ $transaction->id }}</span></strong>
            </td>
        </tr>
        <tr>
            <td colspan="7" align="right">
                <strong>Funding amount: <span class="blue-text">&pound;{{abs($transaction->total_after_fees)}}</span></strong>
            </td>
        </tr>
        <tr>
            <td colspan="7" align="right">
                <strong>Wallet balance after funding: <span class="blue-text">&pound;{{$balance}}</span></strong>
            </td>
        </tr>
    </tbody>
</table>

@stop