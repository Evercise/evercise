@extends('v3.layouts.master')
@section('body')
@include('v3.layouts.stripe_setup', ['route' => 'stripe.sessions'])
<script>
    var viewPrice = '{{ isset($total['subtotal']) ? SessionPayment::poundsToPennies($total['final_cost'])  : null }}';
</script>
<div id="checkout" class="container-fluid bg-grey">
    <div class="container first-container">
        <div class="underline text-center">
            <h1>Checkout</h1>
        </div>
        <div id="masonry" class="row masonry">
            <div class="col-md-6 masonry-item">
                <li class="list-group-item ">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3>Current Balance: <span class="text-primary">£{{round($user->getWallet()->getBalance(), 2)}}</span> </h3>
                        </div>
                        <!--
                        <div class="col-sm-4">
                            <button id="topup-btn" class="btn btn-primary btn-block">Top up</button>
                        </div>
                        -->
                    </div>
                </li>
            </div>
            <div class="col-md-6 masonry-item">
                <ul class="list-group">
                    <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-11">
                                <h3>Class cart </h3>
                            </div>
                            <div class="col-sm-1">
                            <!--
                                {{ Form::open(['route' =>'cart.emptyCart', 'method' => 'post', 'id' => 'empty-cart']) }}
                                    {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-bin hover mt10']) )}}
                                {{Form::close()}}
                                -->
                            </div>
                        </div>
                    </li>
                    <!--
                    <li class="list-group-item">
                        <strong class="list-group-item-heading">Ways to pay</strong>
                        <div class="row mt5">
                            <div class="col-sm-11 mt5">
                                <p class="list-group-item-text">Deduct from my Package</p>
                            </div>
                            <div class="col-sm-1">
                                <span class="icon icon-radio"></span>
                            </div>
                        </div>

                    </li>
                    <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-11">
                                <strong class="list-group-item-heading mb10">Pay with Debit/Credit Card</strong>
                                <p class="list-group-item-text">Pay remaining balance by card</p>
                            </div>
                            <div class="col-sm-1">
                                <span class="icon icon-radio"></span>
                            </div>
                        </div>

                    </li>
                    -->
                    @if($coupon)
                        <li class="list-group-item list-group-item-success">
                            <span class="text-white">Your voucher has been successfully applied</span>
                        </li>
                    @else
                        <li id="voucher" class="list-group-item ">
                            <div class="row mb20">
                                <div class="col-sm-11">
                                    <strong class="list-group-item-heading">I have a Voucher Code</strong>
                                </div>
                                <div class="col-sm-1">
                                    <span id="have-voucher" class="icon icon-radio"></span>
                                </div>
                            </div>

                            <div id="have-voucher-block" class="hidden">
                                {{ Form::open(['route'=> 'cart.coupon', 'method' => 'post', 'id' => 'add-voucher']) }}
                                    <div class="row">
                                        <div class="col-sm-8">
                                            {{ Form::text('coupon', null, ['class' => 'form-control', 'placeholder' => 'Enter your voucher']) }}
                                        </div>
                                        <div class="col-sm-4">
                                            {{ Form::submit('Add Voucher', ['class' => 'btn btn-primary btn-block']) }}
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </li>
                    @endif

                    <li class="list-group-item">
                        <div class="row">
                            <strong class="list-group-item-heading col-sm-3">Quantity</strong>
                            <strong class="list-group-item-heading col-sm-7">Description of Purchase</strong>
                            <strong class="list-group-item-heading col-sm-2 text-right">Cost</strong>
                        </div>
                    </li>
                    @foreach($packages as $row)
                        <li class="list-group-item bg-light-grey">
                            <div class="row">
                                <div class="col-sm-3 text-center">
                                    {{ HTML::linkRoute('packages', 'More', null, ['class' => 'btn btn-info btn-block btn-package']) }}
                                </div>
                                <div class="col-sm-7">
                                    <strong>{{ $row['name'] . ' : ' . $row['classes'] . ' classes'}}</strong><br>
                                </div>
                                <div class="col-sm-2 text-right">
                                    <strong class="text-primary">&pound;{{ $row['price'] }}</strong>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    @foreach($sessions_grouped as $row)
                        <?php
                            $date = new \Carbon\Carbon($row['date_time']);
                        ?>
                        <li class="list-group-item bg-light-grey">
                            <div class="row">
                                <div class="col-sm-3">
                                    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $row['id'], 'class' => 'add-to-class']) }}
                                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                                        {{ Form::hidden('force', true) }}
                                        {{ Form::hidden('refresh-page', true) }}
                                        <div class="btn-group pull-right custom-btn-dropdown-select">
                                            {{ Form::submit( $row['qty'], ['class'=> 'btn btn-primary add-btn']) }}

                                            <select name="quantity" id="quantity" class="btn btn-primary  btn-select">
                                                <option value=""></option>
                                                @for($i = 1; $i < ($row['tickets_left'] <= 50 ? $row['tickets_left'] : 50); $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>

                                    {{ Form::close() }}
                                </div>
                                <div class="col-sm-7">
                                    <strong>{{ $row['name']}}</strong><br>
                                    {{ $date->toDayDateTimeString() }}
                                </div>
                                <div class="col-sm-2 text-right">
                                    <strong class="text-primary">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>&pound'.$row['grouped_price'].'</strike> &pound'.$row['grouped_price_discount'] : '&pound'.$row['grouped_price']) }}</strong>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    <li class="list-group-item bg-light-grey">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <strong>Sub-total</strong>
                                    </div>
                                    <div class="col-sm-7">
                                        <strong class="text-primary">&pound{{ $total['subtotal'] }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                @if($total['package_deduct'] > 0)
                                    <strong>Package deduct: <span class="text-primary"> £{{ $total['package_deduct']  }}</span></strong>
                                    <br>
                                @endif
                                @if($total['from_wallet'] > 0)
                                    <strong>From Wallet: <span class="text-primary">£{{ $total['from_wallet']  }}</span></strong>
                                    <br>
                                @endif
                                @if(!empty($discount['amount']) && $discount['amount'] > 0)
                                    <strong>
                                        Voucher discount: <span class="text-primary">- £{{ $discount['amount'] }}</span>
                                         @if($discount['type'] == 'percentage')
                                             <span class="text-primary">{{ $discount['percentage']}}%</span>
                                         @endif
                                    </strong>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item bg-light-grey">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <strong>Total</strong>
                                    </div>
                                    <div class="col-sm-7">
                                        <strong class="text-primary">&pound{{ $total['final_cost'] }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li  class="list-group-item">
                        <div class="row">
                            @if($total['final_cost'] > 0)
                                <div class="col-sm-5">
                                    <button  id="fb-pay" class="btn btn-info btn-block" onclick="window.location = '{{ URL::route('payment.request.paypal') }}'">Pay with paypal</button>
                                </div>
                                <div class="col-sm-2 text-center mt5">
                                    Or
                                </div>
                                <div class="col-sm-5">
                                    <button id="stripe-button" class="btn btn-primary btn-block">Pay with card</button>
                                </div>
                            @elseif($total['subtotal'] == $total['package_deduct'])
                                <div class="col-sm-5">
                                    {{ Html::linkRoute('wallet.sessions', 'Pay with package',[], ['id'=>'wallet-button', 'class'=>'btn btn-primary btn-block']) }}
                                </div>
                            @else
                                <div class="col-sm-5">
                                    {{ Html::linkRoute('wallet.sessions', 'Pay with wallet',[], ['id'=>'wallet-button', 'class'=>'btn btn-primary btn-block']) }}
                                </div>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
@stop