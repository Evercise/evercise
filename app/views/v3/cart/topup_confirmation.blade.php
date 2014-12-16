@extends('v3.layouts.master')
@section('body')

    <div class="container first-container">
        <div class="row text-center">
            <div class="underline">
                <h1>Topup Confirmation</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4>Topup Confirmation </h4>
                    </div>
                    <div class="panel-body">
                      <p>You topped up your account with the amount of <span class="text-primary">£{{ round($data['amount'],2)}}</span> </p>
                      <p>Your transaction id is: <span class="text-primary">{{$data['transactionId']}}</span></p>
                      <p>Your new balance is: <span class="text-primary">£{{round($data['balance'],2)}}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop