@extends('v3.emails.template')



@section('body')

<p>Dear {{ $user->display_name }}</p>
<p>Thank for your Evercise booking! Please take note of your unique booking code (below). Your trainer will require this and another form of ID.</p>
<strong><p>Transaction ID: {{$transaction->id}}</p></strong>
@stop
@section('extra')
<table class="table" width="100%" height="20" align="left" cellspacing="30" cellpadding="0" bgcolor="#FFFFFF">
    <tbody>
        <tr align="left">
            <th colspan="2">
                Name
            </th>
            <th colspan="2">
                Date
            </th>
            <th>
                Duration
            </th>
            <th>
                QTY
            </th>
            <th>
                Price
            </th>
        </tr>
        @foreach($cart['sessions_grouped'] as $row)
            <?php
                $date = new \Carbon\Carbon($row['date_time']);
            ?>
            <tr  align="left">
                <td colspan="2">
                    {{ Html::linkRoute('class.show', $row['name'], [Evercisegroup::getSlug( $row['evercisegroup_id'] ) ], ['class' => 'blue-text'] ) }}
                </td>
                <td  colspan="2">
                    <p>{{ $date->toDayDateTimeString() }}</p>
                </td>
                <td>
                    <p>{{$row['duration']}} mins</p>
                </td>
                <td>
                    <p>x {{$row['qty']}}</p>
                </td>
                <td>
                    <p>{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>&pound;'.$row['grouped_price'].'</strike> &pound;'.$row['grouped_price_discount'] : '&pound;'.$row['grouped_price']) }}</p>
                </td>
            </tr>
        @endforeach
        @if(isset($cart['packages']))
            @foreach($cart['packages'] as $row)
                <tr  align="left">
                    <td colspan="2">
                        <p>{{ $row['name'] }}</p>
                    </td>
                    <td  colspan="2">
                        <p>{{ $row['classes'] }} classes</p>
                    </td>
                    <td>

                    </td>
                    <td>
                    <td>
                        <p>1</p>
                    </td>
                    <td>
                        <p>&pound;{{ $row['price'] }}</p>
                    </td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td colspan="7" >
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
            </td>
        </tr>
        @if($cart['total']['final_cost'] > 0)
        <tr>
            <td colspan="7" align="right">
                <strong>Total <span class="blue-text">&pound;{{$cart['total']['final_cost']}}</span></strong>
            </td>

        </tr>
        @endif
    </tbody>
</table>

@stop