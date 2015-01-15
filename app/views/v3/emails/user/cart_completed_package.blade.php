@extends('v3.emails.template')



@section('body')

<p>Dear {{ $user->display_name }}</p>
<p>Thank for your Evercise booking! Please take note of your unique booking code (below). Your trainer will require this and another form of ID.</p>
<strong><p>Transaction ID: {{$transaction->id}}</p></strong>
@stop
@section('extra')
<table class="table" width="100%" height="auto" align="left" cellspacing="0" cellpadding="30" bgcolor="#FFFFFF">
    <tbody>
        <tr>
            <td>
                <table class="table" width="100%" height="20" align="left" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                    <tbody>
                        <tr align="left">
                            <th colspan="2">
                                Name
                            </th>
                            <th colspan="2">
                                Package type
                            </th>
                            <th>
                                Price
                            </th>
                        </tr>
                        @if(isset($cart['packages']))
                            @foreach($cart['packages'] as $row)
                                <tr  align="left">
                                    <td colspan="2">
                                        <p>{{ $row['name'] }}</p>
                                    </td>
                                    <td  colspan="3">
                                        <p>{{ $row['classes'] }} classes</p>
                                    </td>
                                    <td>
                                        <p>&pound;{{ $row['price'] }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="7" align="left">
                                <br>
                                <br>
                                <strong>Sub-total <span class="blue-text">&pound;{{ $cart['total']['subtotal'] }}</span></strong>
                                @if($cart['total']['package_deduct'] > 0)
                                    <strong>Package deduct: <span class="blue-text"> &pound;{{ $cart['total']['package_deduct']  }}</span></strong>
                                    <br/>
                                @endif
                                @if($cart['total']['from_wallet'] > 0)
                                    <strong>From Wallet: <span class="blue-text"> &pound;{{ $cart['total']['from_wallet']  }}</span></strong>
                                    <br/>
                                @endif
                                @if(!empty($cart['discount']['amount']) && $cart['discount']['amount'] > 0)
                                    <strong>
                                        Voucher discount: <span class="blue-text">-  &pound;{{ $cart['discount']['amount'] }}</span>
                                         @if($cart['discount']['type'] == 'percentage')
                                             <span class="blue-text">{{ $cart['discount']['percentage']}}%</span>
                                         @endif
                                    </strong>
                                @endif
                                <br>
                                <br>
                            </td>
                        </tr>
                        @if($cart['total']['final_cost'] > 0)
                        <tr>
                            <td colspan="7" align="left">
                                <strong>Total <span class="blue-text">&pound;{{$cart['total']['final_cost']}}</span></strong>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

    @include('v3.emails.classes_upsell', ['everciseGroups' => $everciseGroups, 'upsellText' => 'Here are a few classes you could attend using your new package'])

@stop