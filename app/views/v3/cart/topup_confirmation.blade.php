@extends('v3.layouts.master')
@section('body')

    <br>
    <div class="container mt30">
        <h2>Topup Confirmation</h2>
    </div>

    <strong class="text-primary">Topup successful: {{$data['amount']}}</strong>
    <br>
    <strong>Total: £{{ $data['amount'] }}</strong>
    <strong>Token: {{ $data['token'] }}</strong>
    <strong>Transaction id:{{ $data['transactionId'] }}</strong>



@stop