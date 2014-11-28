@extends('v3.layouts.master')
@section('body')
    <div class="container first-container">
        <h2 class="text-center">Topup Confirmation</h2>
        <ul class="col-sm-6 col-sm-offset-3 list-grou mt30">
          <li class="list-group-item">
            <span class="badge">{{$data['amount']}}</span>
            <strong class="text-primary">Topup successful:</strong>
          </li>
          <li class="list-group-item">
            <span class="badge">{{$data['transactionId']}}</span>
            <strong>Transaction id:</strong>
          </li>
        </ul>
    </div>
@stop