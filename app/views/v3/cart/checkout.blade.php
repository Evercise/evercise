@extends('v3.layouts.master')
@section('body')

    <br>
    <div class="container mt30">
        <h2>checkout</h2>
    </div>

    <ul>
        @foreach($data['cartRows'] as $row)
            <li>{{ $row->name . ' : ' . $row->options->date_time . ' : £' . $row->price }}</li>
            <strong class="text-primary">x{{$row->qty}} . subtotal: &pound;{{ $row->price * $row->qty }}</strong>
        @endforeach
    </ul>

    <strong>Total: £{{ $data['total'] }}</strong>


    {{ Form::open(array('id' => 'join-sessions-stripe', 'url' => 'stripe/', 'method' => 'post', 'class' => '')) }}
        <script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
          data-key="@stripeKey"
          data-image="{{url()}}/img/evercoin.png"
          data-name="Evercise"
          data-currency="gbp"
          data-email="{{ $user->email}}"
          data-address="true"
          data-description="">
          </script>
    {{ Form::close() }}


@stop