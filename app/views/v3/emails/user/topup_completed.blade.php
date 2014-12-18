@extends('v3.emails.template')



@section('body')

<p>Hi {{ $user->first_name }}</p>

<p>Thank you for funding your Evercise wallet.</p>
<p>You will find a copy of the transaction below.</p>
<p>Please keep this in a safe place for future reference.</p>
@stop
@section('extra')
<table class="table" width="60%" height="auto" align="left" cellspacing="10" cellpadding="0" bgcolor="#FFFFFF">
    <tbody>
        <tr>
            <td width="20"></td>
        </tr>

        <tr>
            <td  align="center" >
                <strong>Username:</strong>
            </td>
            <td align="center">
                <span class="blue-text">{{ $user->display_name }}</span>
            </td>
        </tr>
        <tr>
            <td align="center" >
                <strong>Full name:</strong>
            </td>
            <td align="center" >
                <span class="blue-text">{{ $user->first_name . ' ' . $user->last_name }}</span>
            </td>
        </tr>
        <tr>
            <td align="center" >
                <strong>Charge method:</strong>
            </td>
            <td align="center" >
                <span class="blue-text">{{ $transaction->payment_method }}</span>
            </td>
        </tr>
        <tr>
            <td align="center" >
                <strong>Date charged:</strong>
            </td>
            <td align="center" >
                <span class="blue-text">{{ $transaction->formattedDate() }}</span>
            </td>
        </tr>
        <tr>
            <td center align="center" >
                <strong>Transaction ID:</strong>
            </td>
            <td center align="center" >
                 <span class="blue-text">{{ $transaction->id }}</span>
            </td>
        </tr>
        <tr>
            <td  align="center">
                <strong>Funding amount:</strong>
            </td>
            <td  align="center">
                <span class="blue-text">&pound;{{abs($transaction->total_after_fees)}}</span>
            </td>
        </tr>
        <tr>
            <td align="center">
                <strong>Wallet balance after funding:</strong>
            </td>
            <td align="center">
                <span class="blue-text">&pound;{{$balance}}</span>
            </td>
        </tr>
    </tbody>
</table>

@stop