@if(!isset($single))
<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($title)? $title : 'Everyone exercise'}}</title>
    <meta name="description" content="{{ isset($metaDescription)? $metaDescription : 'Lower your barrier to enjoy fitness classes, Flexible schedule and multiple options across London.'}}">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta charset="UTF-8">
    <meta name="language" content="en-UK" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {{ HTML::style('assets/css/main.min.css?vs='.$version) }}
</head>
<body>
    <div class="container first-container">
@else
@extends('v3.layouts.master')
@section('body')
@endif
        <div class="row">
            <div class="col-xs-8 col-sm-offset-2">
                <div class="row">
                    <div class="col-xs-7">
                      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand' ])}}
                      <h1><small>Invoice <strong> {{ $transaction->id }}</strong></small></h1>
                    </div>
                    <div class="col-xs-5">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
                        </div>
                      </div>
                    </div>


                </div>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                          <h4>Product</h4>
                        </th>
                        <th>
                          <h4>Qty</h4>
                        </th>
                        <th>
                          <h4>Price</h4>
                        </th>
                        <th>
                          <h4>Sub Total</h4>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $item)
                          <tr>
                            <td>{{$item->name}}</td>
                            <td class="text-right">1</td>
                            <td class="text-right">£{{ number_format($item->amount, 2) }}</td>
                            <td class="text-right">£{{ number_format($item->final_price, 2) }}</td>
                          </tr>
                      @endforeach


                    </tbody>
                  </table>
                  <div class="row text-right">
                    <div class="col-xs-5 col-xs-offset-7">
                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <h4>Total</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-8 text-right">
                                  <p>
                                    <strong>
                                    Sub Total :  <br/>
                                    TAX :  <br/>
                                    @if(number_format($total, 2) != number_format($transaction->total, 2))
                                    Discounts: <br/>
                                    @endif
                                    Total : <br/>
                                    </strong>
                                  </p>
                                </div>
                                <div class="col-xs-4">
                                  <strong>
                                  £{{ number_format($total, 2) }} <br/>
                                  N/A <br/>
                                  @if(number_format($total, 2) != number_format($transaction->total, 2))
                                  -£{{ number_format(abs(number_format($transaction->total, 2) - number_format($total, 2)), 2) }} <br/>
                                  @endif
                                  £{{ number_format($transaction->total) }}  <br/>
                                  </strong>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>

                </div>
            </div>
        </div>
    @if(!isset($single))
    </div>
</body>
</html>
@else
@stop
@endif
