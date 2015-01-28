@extends('v3.layouts.master')
@section('body')
@include('v3.layouts.stripe_setup', ['route' => 'stripe.sessions'])
<script>
    var VIEWPRICE = '{{ isset($total['final_cost']) ? SessionPayment::poundsToPennies($total['final_cost'])  : null }}';
</script>
<div class="container">
    <div class="row">
        <div class="page-header col-sm-12">
            <h1 class="h2">Checkout</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <ul class="checkout">

                 <div id="step-1" class="cart-step">
                    <li class="title active"><div class="col-sm-12">Review Order</div></li>
                    @include('v3.cart.checkout.step1')
                 </div>
                 <hr class="dark">
                 <li class="text-right">
                    <a data-step="1" class="collapsed btn btn-white-primary continue" data-toggle="collapse"  href="#step-2">Continue</a>
                 </li>

                 <li class="title"><div class="col-sm-12">Details & Payment</div></li>
                 @if(!isset($user))
                 <div id="step-2" class="cart-step collapse">
                     <div class="col-sm-10 col-sm-offset-1 mt25">

                        <div class="form-group">
                            <label for="email">What  is your Email Address?</label>
                            <div class="input-group mt10">
                                <div class="input-group-addon"><strong>EMAIL</strong></div>
                                {{ Form::email('email',null, ['class'=>'form-control input-lg', 'placeholder' => 'aname@address.com']) }}
                            </div>
                        </div>
                        <div class="text-divider mb15">or</div>
                        {{ Html::linkRoute('users.fb', 'Connect via Facebook', null, ['class' => 'custom-fb mb15']) }}
                        <label for="account">Do you have a Evercise account?</label>
                        <ul class="list-group mt10">
                            <li class="list-group-item">
                                <div class="custom-checkbox">
                                    {{ Form::checkbox('new', 'yes', false , ['id'=> 'new']) }}
                                    <label for="new" >I'm a new customer</label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="custom-checkbox">
                                            {{ Form::checkbox('ps', 'yes', false , ['id'=> 'ps']) }}
                                            <label for="ps" >Yes I have a Password:</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">{{ Form::password('password',['class' => 'form-control input-sm']) }}</div>
                                </div>
                            </li>
                            <div class="pull-right mt15">
                                {{ HTML::linkRoute('auth.forgot', 'Forgot your Password?' , null, ['class' => 'text-right link']) }}
                            </div>
                            <li class="text-right">
                                <button class="btn btn-white-primary ">Continue</button>
                            </li>
                        </ul>

                     </div>
                 </div>
                 @else
                 <div id="step-2" class="cart-step collapse">
                     <div class="col-sm-8 col-sm-offset-2 text-center mt30">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                Welcome back, mewis (<a href="{{ URL::route('auth.logout') }}" class="link">not you?</a>), how would you like to pay?
                                <div class="mt10">
                                    <strong class="text-largest">Pay with:</strong>
                                </div>
                                <div class="row mt20">
                                    <div class="col-xs-6"><button  id="fb-pay" class="btn btn-paypal btn-block" onclick="window.location = '{{ URL::route('payment.request.paypal') }}'">Pay with paypal</button></div>
                                    <div class="col-xs-6"><button id="stripe-button" class="btn btn-primary btn-block">Pay with card</button></div>
                                </div>
                            </div>
                        </div>

                     </div>
                 </div>
                 @endif
                 <li class="title mb50"><div class="col-sm-12">Confirmation</div></li>
            </ul>
        </div>
        <div class="col-sm-3">
           <ul class="cart-progress">
                <li class="title active"><span class="icon icon-cross mr10"></span>Review Order</li>
                <div id="progress-2">
                    <li class="content">Total <strong class="pull-right text-primary">£{{ number_format($total['final_cost'], 2,'.','') }}</strong></li>
                    <li class="title"><span class="icon icon-cross mr10"></span>Payment Method</li>
                </div>

                <li class="content"></li>
                <li class="title"><span class="icon icon-cross mr10"></span>Confirmation</li>
           </ul>
        </div><div class="col-sm-3">
           <ul class="cart-progress">
                <li class="title active"><span class="icon icon-cross mr10"></span>Review Order</li>
                <div id="progress-2">
                    <li class="content">Total <strong class="pull-right text-primary">£{{ number_format($total['final_cost'], 2,'.','') }}</strong></li>
                    <li class="title"><span class="icon icon-cross mr10"></span>Payment Method</li>
                </div>

                <li class="content"></li>
                <li class="title"><span class="icon icon-cross mr10"></span>Confirmation</li>
           </ul>
        </div>
    </div>
</div>
<!--
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

                            </div>
                        </div>
                    </li>

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

                    <li class="list-group-item hidden-mob">
                        <div class="row">
                            <strong class="list-group-item-heading col-xs-3">Quantity</strong>
                            <strong class="list-group-item-heading col-xs-6">Description of Purchase</strong>
                            <strong class="list-group-item-heading col-xs-2 text-right">Cost</strong>
                        </div>
                    </li>
                    @foreach($packages as $row)
                        <li class="list-group-item bg-light-grey">
                            <div class="row">
                                <div class="col-sm-3 text-center hidden-mob">
                                    {{ image('assets/img/More_'.$row['style'].'.png', 'package', ['class' => 'img-responsive']) }}
                                </div>
                                <div class="col-md-6">
                                    <strong>{{ $row['name'] . ' : ' . $row['classes'] . ' classes'}}</strong>
                                    <strong class="text-primary text-right hidden-lg sm-pull-right">&pound;{{ round($row['price'], 2) }}</strong>
                                </div>
                                <div class="col-sm-2 text-right hidden-mob">
                                    <strong class="text-primary">&pound;{{ round($row['price'], 2) }}</strong>
                                </div>
                                <div class="col-xs-1 hidden-mob">
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
                                <div class="col-sm-3 hidden-mob">

                                    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $row['id'], 'class' => 'add-to-class']) }}
                                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                                        {{ Form::hidden('force', true) }}
                                        {{ Form::hidden('refresh-page', true) }}
                                        <div class="btn-group btn-block">
                                            {{ Form::submit( $row['qty'], ['class'=> 'btn btn-primary add-btn']) }}
                                            <div class="btn btn-primary btn-aside">
                                                <div class="custom-select btn-drop">
                                                    <select name="quantity" id="quantity" class="btn-primary btn-select ">
                                                        <option value=""></option>
                                                        @for($i = 1; $i <= ($row['tickets_left'] /*<= 10 ? $row['tickets_left'] : 10*/); $i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>

                                                    <span class="caret"></span>
                                                </div>
                                            </div>

                                        </div>

                                    {{ Form::close() }}
                                </div>
                                <div class="col-md-6">
                                    <strong>{{ $row['name']}}</strong>
                                    <strong class="text-primary hidden-lg hidden-md sm-pull-right">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>&pound'.round($row['grouped_price'],2).'</strike> &pound'.round($row['grouped_price_discount'],2) : '&pound'.round($row['grouped_price'],2) ) }}</strong>
                                    <br>
                                    {{ $date->toDayDateTimeString() }}

                                </div>
                                <div class="col-sm-2 text-right hidden-mob">
                                    <strong class="text-primary">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>&pound'.round($row['grouped_price'],2).'</strike> &pound'.round($row['grouped_price_discount'],2) : '&pound'.round($row['grouped_price'],2) ) }}</strong>
                                </div>
                                <div class="col-xs-1 hidden-mob">
                                    {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
                                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                                        {{ Form::hidden('refresh-page', true) }}
                                        {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-cross hover']) )}}
                                    {{Form::close()}}
                                </div>
                                <div class="visible-sm-block visible-xs-block sm-mt25">
                                    <div class="col-xs-6">
                                        {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
                                            {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                                            {{ Form::submit('Remove', ['class' => 'btn btn-light btn-block']) }}
                                        {{Form::close()}}
                                    </div>
                                    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $row['id'], 'class' => 'add-to-class']) }}
                                    {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                                    {{ Form::hidden('force', true) }}
                                    <div class="col-xs-6">
                                        <div class="toggle-select row" data-trigger="true" data-qty="{{$row['tickets_left']}}">
                                            <div class="switch col-xs-3"><a href="#minus">-</a></div>
                                            <div id="qty" class="col-xs-6 text-center">{{ !empty($cart_items[$row['id']]) ?  $cart_items[$row['id']] : 1}}</div>
                                            <div class="switch col-xs-3"><a href="#plus">+</a> </div>
                                            {{Form::hidden('quantity', !empty($cart_items[$row['id']]) ?  $cart_items[$row['id']] : 1 ,['id' => 'toggle-quantity'])}}
                                        </div>
                                    </div>
                                    {{ Form::close() }}
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
                                <div class="col-sm-5 sm-mb10">
                                    <button  id="fb-pay" class="btn btn-info btn-block" onclick="window.location = '{{ URL::route('payment.request.paypal') }}'">Pay with paypal</button>
                                </div>
                                <div class="col-xs-2 hidden-xs text-center mt5">
                                    Or
                                </div>
                                <div class="col-sm-5">
                                    <button id="stripe-button" class="btn btn-primary btn-block">Pay with card</button>
                                </div>
                            @elseif($total['subtotal'] == $total['package_deduct'])
                                <div class="col-sm-5 sm-mb10">
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