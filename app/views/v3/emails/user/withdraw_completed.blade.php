@extends('v3.emails.template')



@section('body')

<p>Dear {{ $user->first_name }}</p>
<p>Withdraw has been scheduled. Please allow 7 working days for the money to reach your specified Paypal account.</p>
<strong><p>Transaction ID: {{$transaction->id}}</p></strong>
@stop
@section('extra')
<table class="table" width="100%" height="20" align="left" cellspacing="30" cellpadding="0" bgcolor="#FFFFFF">
    <tbody>
        <tr>
            <td colspan="7" >
                <strong>Sub-total <span class="blue-text">&pound;{{ abs($transaction->total)}}</span></strong>
            </td>
        </tr>
        <tr>
            <td colspan="7" align="right">
                <strong>Total <span class="blue-text">&pound;{{ abs($transaction->total_after_fees)}}</span></strong>
            </td>
        </tr>
        <tr>
            <td colspan="7" align="right">
                <strong>New wallet balance <span class="blue-text">&pound;{{$balance}}</span></strong>
            </td>
        </tr>
    </tbody>
</table>

@stop