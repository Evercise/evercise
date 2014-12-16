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
        <div id="" class="row ">
            <div class="col-md-6">
                <ul class="list-group mb20">
                    <li class="list-group-item">
                        <h3>Current Balance: <span class="text-primary">£{{round($user->getWallet()->getBalance(), 2)}}</span> </h3>
                    </li>
                    <li class="list-group-item">
                        <span class="text-grey">You can top up your account at any time using:</span>
                    </li>
                    <li class="list-group-item bg-grey">
                        {{ image('/img/payment_paypal.png', 'pay with paypal') }}
                        {{ image('/img/payment_stripe.png', 'pay with paypal', ['class'=>'ml30 mt10']) }}
                    </li>
                </ul>

                 <ul class="list-group package-stacked-list">
                    <li class="list-group-item ">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3>Add a package </h3>
                            </div>
                        </div>
                    </li>
                    @foreach($packages_available as $style => $arr)
                        <li class="list-group-item package-list-item package-{{$style}}">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h3>{{ $arr[0]->name }}</h3>
                                    <small>Classes up to £{{ $arr[0]->max_class_price }}</small>
                                </div>
                                @foreach($arr as $p)
                                    <div class="col-sm-4 text-center">
                                        {{ $p->classes }} Class Package
                                        <strong class="text-larger">£{{ round($p->price,2) }}</strong>
                                        {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $p->id, 'class' => 'add-to-class mt5']) }}
                                            {{ Form::submit('Add Package', ['class'=> 'btn btn-white btn-transparent  add-btn']) }}
                                            {{ Form::hidden('product-id', EverciseCart::toProductCode('package', $p->id)) }}
                                            {{ Form::hidden('refresh-page', true) }}
                                            {{ Form::hidden('quantity', 1) }}
                                        {{ Form::close() }}
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                 </ul>
            </div>





            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item ">
                        <div class="row">
                            <div class="col-xs-11">
                                <h3>Class cart </h3>
                            </div>
                            <div class="col-xs-1">
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
                            <div class="row ">
                                <div class="col-xs-11">
                                    <strong class="list-group-item-heading">I have a Voucher Code</strong>
                                </div>
                                <div class="col-xs-1">
                                    <span id="have-voucher" class="icon icon-radio"></span>
                                </div>
                            </div>

                            <div id="have-voucher-block" class="hidden mt20">
                                {{ Form::open(['route'=> 'cart.coupon', 'method' => 'post', 'id' => 'add-voucher']) }}
                                    <div class="row">
                                        <div class="col-xs-8">
                                            {{ Form::text('coupon', null, ['class' => 'form-control', 'placeholder' => 'Enter your voucher']) }}
                                        </div>
                                        <div class="col-xs-4">
                                            {{ Form::submit('Add Voucher', ['class' => 'btn btn-primary btn-block']) }}
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </li>
                    @endif

                    <li class="list-group-item">
                        <div class="row">
                            <strong class="list-group-item-heading col-xs-3">Quantity</strong>
                            <strong class="list-group-item-heading col-xs-6">Description of Purchase</strong>
                            <strong class="list-group-item-heading col-xs-2 text-right">Cost</strong>
                        </div>
                    </li>
                    @foreach($packages as $row)
                        <li class="list-group-item bg-light-grey">
                            <div class="row">
                                <div class="col-xs-3 text-center">
                                    {{ HTML::linkRoute('packages', 'More', null, ['class' => 'btn btn-info btn-block btn-package']) }}
                                </div>
                                <div class="col-xs-6">
                                    <strong>{{ $row['name'] . ' : ' . $row['classes'] . ' classes'}}</strong><br>
                                </div>
                                <div class="col-xs-2 text-right">
                                    <strong class="text-primary">&pound;{{ round($row['price'], 2) }}</strong>
                                </div>
                                <div class="col-xs-1">
                                    {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
                                        {{ Form::hidden('product-id', EverciseCart::toProductCode('package', $row['id'])) }}
                                        {{ Form::hidden('refresh-page', true) }}
                                        {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-cross hover']) )}}
                                    {{Form::close()}}
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
                                <div class="col-xs-3">

                                    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $row['id'], 'class' => 'add-to-class']) }}
                                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                                        {{ Form::hidden('force', true) }}
                                        {{ Form::hidden('refresh-page', true) }}
                                        <div class="btn-group custom-btn-dropdown-select">
                                            {{ Form::submit( $row['qty'], ['class'=> 'btn btn-primary add-btn']) }}

                                            <select name="quantity" id="quantity" class="btn btn-primary  btn-select">
                                                <option value=""></option>
                                                @for($i = 1; $i <= ($row['tickets_left'] <= 50 ? $row['tickets_left'] : 50); $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>

                                    {{ Form::close() }}
                                </div>
                                <div class="col-xs-6">
                                    <strong>{{ $row['name']}}</strong><br>
                                    {{ $date->toDayDateTimeString() }}
                                </div>
                                <div class="col-xs-2 text-right">
                                    <strong class="text-primary">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>&pound'.round($row['grouped_price'],2).'</strike> &pound'.round($row['grouped_price_discount'],2) : '&pound'.round($row['grouped_price'],2) ) }}</strong>
                                </div>
                                <div class="col-xs-1">
                                    {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
                                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                                        {{ Form::hidden('refresh-page', true) }}
                                        {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-cross hover']) )}}
                                    {{Form::close()}}
                                </div>
                            </div>
                        </li>
                    @endforeach
                    <li class="list-group-item bg-light-grey">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <strong>Sub-total</strong>
                                    </div>
                                    <div class="col-xs-7">
                                        <strong class="text-primary">&pound{{ round($total['subtotal'], 2) }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 text-right">
                                @if($total['package_deduct'] > 0)
                                    <strong>Package deduct: <span class="text-primary"> £{{ round($total['package_deduct'],2)  }}</span></strong>
                                    <br>
                                @endif
                                @if($total['from_wallet'] > 0)
                                    <strong>From Wallet: <span class="text-primary">£{{ round($total['from_wallet'],2)  }}</span></strong>
                                    <br>
                                @endif
                                @if(!empty($discount['amount']) && $discount['amount'] > 0)
                                    <strong>
                                        Voucher discount: <span class="text-primary">- £{{ round($discount['amount'] ,2)}}</span>
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
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <strong>Total</strong>
                                    </div>
                                    <div class="col-xs-7">
                                        <strong class="text-primary">&pound{{ round($total['final_cost'], 2) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li  class="list-group-item">
                        <div class="row">
                            @if($total['final_cost'] > 0)
                                <div class="col-xs-5">
                                    <button  id="fb-pay" class="btn btn-info btn-block" onclick="window.location = '{{ URL::route('payment.request.paypal') }}'">Pay with paypal</button>
                                </div>
                                <div class="col-xs-2 text-center mt5">
                                    Or
                                </div>
                                <div class="col-xs-5">
                                    <button id="stripe-button" class="btn btn-primary btn-block">Pay with card</button>
                                </div>
                            @elseif($total['subtotal'] == $total['package_deduct'])
                                <div class="col-xs-5">
                                    {{ Html::linkRoute('wallet.sessions', 'Pay with package',[], ['id'=>'wallet-button', 'class'=>'btn btn-primary btn-block']) }}
                                </div>
                            @else
                                <div class="col-xs-5">
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