@extends('v3.layouts.master')
@section('body')

    <br>
    <div class="container mt30">
        <h2>Confirmation</h2>
    </div>

    <ul>
        @foreach($data['cartRows'] as $row)
            <li>{{ $row->name . ' : ' . $row->options->date_time . ' : £' . $row->price }}</li>
            <strong class="text-primary">x{{$row->qty}} . subtotal: &pound;{{ $row->price * $row->qty }}</strong>
        @endforeach
    </ul>

    <strong>Total: £{{ $data['total'] }}</strong>
    <strong>Paid from wallet: £{{ $data['walletPayment'] }}</strong>
    <strong>Total: £{{ $data['total'] }}</strong>



@stop