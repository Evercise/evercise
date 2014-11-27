@extends('v3.layouts.master')
@section('body')

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