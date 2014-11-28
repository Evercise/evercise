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
                    <li id="voucher" class="list-group-item ">
                        <div class="row mb20">
                            <div class="col-sm-11">
                                <strong class="list-group-item-heading">I have a Voucher Code</strong>
                            </div>
                            <div class="col-sm-1">
                                <span id="have-voucher" class="icon icon-radio"></span>
                            </div>
                        </div>
                        {{ var_dump($coupon) }}
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

                    <li class="list-group-item list-group-item-success">
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
                                    <strong>1</strong>
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
                                                @for($i = 1; $i < 10; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <!--
                                        <div class="btn-group">
                                          <button type="submit" class="btn btn-primary">{{ $row['qty'] }}</button>
                                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                            @for($i = 1; $i < 10; $i++)
                                                <li><a href="#{{$i}}">purchase {{$i}} of this class</a></li>
                                            @endfor
                                          </ul>
                                        </div>
                                        -->
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
                            <div class="col-sm-6">
                                <div class="row text-right">
                                    <div class="col-sm-5">
                                        <strong>Discount</strong>
                                    </div>
                                    <div class="col-sm-7">
                                        <strong class="text-primary">{{ $discount['amount'] or 0 }}%</strong>
                                    </div>
                                </div>
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
                            <div class="col-sm-5">
                                <button id="fb-pay" class="btn btn-info btn-block">Pay with paypal</button>
                            </div>
                            <div class="col-sm-2 text-center mt5">
                                Or
                            </div>
                            <div class="col-sm-5">
                                <button id="stripe-button" class="btn btn-primary btn-block">Pay with card</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

    <br>
    <div class="container mt30">
        <h2>Checkout</h2>
    </div>
    <ul>
        @foreach($packages as $row)
            <li>{{ $row['name'] . ' : ' . $row['classes'] . ' classes'}}</li>
            <strong class="text-primary">Total:£{{ $row['price'] }}</strong>
        @endforeach


        @foreach($sessions_grouped as $row)
        <?php
        $date = new \Carbon\Carbon($row['date_time']);
        ?>
            <li>{{ $row['name']}} {{ $date->toDayDateTimeString() }}</li>
            <strong>QTY: {{ $row['qty'] }}</strong>

            <strong class="text-primary">
            {{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>£'.$row['grouped_price'].'</strike> £'.$row['grouped_price_discount'] : $row['grouped_price']) }}
            </strong>
        @endforeach
    </ul>

    <div class="btn-group col-sm-2">
        {{ Form::open(array('id' => 'add-coupon', 'url' => 'ajax/cart/add', 'method' => 'post', 'class' => '')) }}
            {{ Form::hidden( 'product-id' , 'W', array('id' => 'product-id')) }}
            {{ Form::hidden( 'amount' , '10', array('id' => 'amount')) }}
            {{ Form::submit('pay with wallet (&pound;10)' , array('class'=>'btn btn-primary btn-sm btn-block', 'id' => '')) }}
        {{ Form::close() }}
    </div>


    <div class="col-xs-3">
        <strong>Sub-total</strong>
    </div>
    <div class="col-xs-5">
        <strong class="text-primary">&pound;<span id="cart-sub-total">{{ $total['subtotal'] }}</span></strong>
    </div>
    <div class="col-xs-2">
        <strong>Discount</strong>
    </div>
    <div class="col-xs-2">
        <strong class="text-primary"><span id="cart-discount">{{ $discount['amount'] or 0 }}</span>%</strong>
    </div>
    <li class="divider col-xs-12"></li>

    <div class="col-xs-3">
        <strong>Total</strong>
    </div>
    <div class="col-xs-5">
        <strong class="text-primary">&pound;<span id="cart-total">{{ $total['final_cost'] }}</span></strong>




        <strong>Total: £{{ $total['subtotal']  }}</strong>
        <br>
    @if($total['package_deduct'] > 0)
        <strong>Package deduct: - £{{ $total['package_deduct']  }}</strong>
        <br>
    @endif
    @if($total['from_wallet'] > 0)
        <strong>From Wallet: - £{{ $total['from_wallet']  }}</strong>
        <br>
    @endif
    @if(!empty($discount['amount']) && $discount['amount'] > 0)
        <strong>Coupon discount:
            - £{{ $discount['amount'] }}
        @if($discount['type'] == 'percentage')
            {{ $discount['percentage']}}%
        @endif

    @endif
    </strong>
    <br>
    <br>
    <strong>To Pay: £{{ $total['final_cost'] }}</strong>

    <br/>
    <br/>
    <strong>PAYPAL</strong>

    <br/>
    <br/>
    <strong>STRIPE</strong>
    {{ Form::open(array('id' => 'join-sessions-stripe', 'route' => 'stripe.sessions', 'method' => 'post', 'class' => '')) }}
        <script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
          data-key="@stripeKey"
          data-image="{{url()}}/img/evercoin.png"
          data-name="Evercise"
          data-currency="gbp"
          data-email="{{ $user->email}}"
          data-address="true"
          data-description=""
          data-amount="{{( SessionPayment::poundsToPennies($total['final_cost']) )}}">
          </script>
    {{ Form::close() }}


@stop