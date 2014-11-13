@extends('v3.layouts.master')
@section('body')

    <br>
    <div class="container mt30">
        <h2>checkout</h2>
    </div>

    <ul>
        @foreach($data['cart']['cartRows'] as $row)
            <li>{{ $row->name . ' : ' . $row->options->date_time . ' : £' . $row->price }}</li>
            <strong class="text-primary">x{{$row->qty}} . subtotal: &pound;{{ $row->price * $row->qty }}</strong>
        @endforeach
    </ul>

    <strong>Total: £{{ $data['cart']['total'] }}</strong>
    <br>
    <strong>From Wallet: £{{ $data['wallet_payment'] }}</strong>
    <br>
    <strong>To Pay: £{{ $data['cart']['total'] - $data['wallet_payment'] }}</strong>


    <div class="btn-group col-sm-2">
        {{ Form::open(array('id' => 'add-wallet-payment', 'url' => 'ajax/cart/add', 'method' => 'post', 'class' => '')) }}
            {{ Form::hidden( 'product-id' , 'W', array('id' => 'product-id')) }}
            {{ Form::hidden( 'amount' , '10', array('id' => 'amount')) }}
            {{ Form::submit('pay with wallet (&pound;10)' , array('class'=>'btn btn-primary btn-sm btn-block', 'id' => '')) }}
        {{ Form::close() }}
    </div>


    {{ Form::open(array('id' => 'join-sessions-stripe', 'url' => 'stripe/sessions/', 'method' => 'post', 'class' => '')) }}
        <script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
          data-key="@stripeKey"
          data-image="{{url()}}/img/evercoin.png"
          data-name="Evercise"
          data-currency="gbp"
          data-email="{{ $user->email}}"
          data-address="true"
          data-description=""
          data-amount="{{( SessionPayment::poundsToPennies($data['cart']['total'] - $data['wallet_payment']) )}}">
          </script>
    {{ Form::close() }}


@stop