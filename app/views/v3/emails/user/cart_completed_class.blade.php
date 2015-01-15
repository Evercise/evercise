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
            <th>
                <table class="table" width="100%" height="auto" align="left" cellspacing="" cellpadding="0" bgcolor="#FFFFFF">
                    <tbody>
                        <tr align="left" height="50">
                            <th colspan="2">
                                Name
                            </th>
                            <th colspan="3">
                                Date
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Code
                            </th>
                        </tr>
                        @foreach($cart['sessions_grouped'] as $sessionId => $row)
                            <?php
                                $date = new \Carbon\Carbon($row['date_time']);
                            ?>
                            <tr  align="left">
                                <td colspan="2">
                                    <p>{{ Html::linkRoute('class.show', $row['name'], [Evercisegroup::getSlug( $row['evercisegroup_id'] ) ], ['class' => 'blue-text'] ) }}</p>
                                </td>
                                <td  colspan="3">
                                    <p>{{ $date->toDayDateTimeString() }}</p>
                                </td>
                                <td>
                                    <p>{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>&pound;'.$row['grouped_price'].'</strike> &pound;'.$row['grouped_price_discount'] : '&pound;'.$row['grouped_price']) }}</p>
                                </td>
                                <td>
                                    <p>
                                        @foreach($transaction->makeBookingHashBySession($sessionId) as $hash)
                                            {{ $hash }}<br>
                                        @endforeach
                                    </p>
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
                            <td colspan="7" align="left">
                                <br>
                                <br>
                                <strong>Sub-total <span class="blue-text">&pound;{{ number_format($cart['total']['subtotal'], 2) }}</span></strong>
                                @if($cart['total']['package_deduct'] > 0)
                                    <strong>Package deduct: <span class="blue-text"> &pound;{{ number_format($cart['total']['package_deduct'], 2)  }}</span></strong>
                                    <br/>
                                @endif
                                @if($cart['total']['from_wallet'] > 0)
                                    <strong>From Wallet: <span class="blue-text"> &pound;{{ number_format($cart['total']['from_wallet'], 2)  }}</span></strong>
                                    <br/>
                                @endif
                                @if(!empty($cart['discount']['amount']) && $cart['discount']['amount'] > 0)
                                    <strong>
                                        Voucher discount: <span class="blue-text">-  &pound;{{ number_format($cart['discount']['amount'], 2) }}</span>
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
                                <strong>Total <span class="blue-text">&pound;{{number_format($cart['total']['final_cost'], 2)}}</span></strong>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </th>
        </tr>
    </tbody>
</table>
@stop