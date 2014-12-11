@extends('v3.emails.template')



@section('body')

<p>Dear {{ $user->display_name }}</p>
<p>Thank for your Evercise booking! Please take note of your unique booking code (below). Your trainer will require this and another form of ID.</p>
<strong><p>Transaction ID: {{$transaction->transaction}}</p></strong>
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
                $eg =  Evercisegroup::select('image', 'user_id')->where( 'id', $row['evercisegroup_id'])->first();
                $directory = User::find($eg->user_id)->directory;
                $image = $directory .'/thumb_'.$eg->image;
            ?>
            <tr  align="left">
                <td colspan="2">
                    {{ Html::linkRoute('class.show', $row['name'], [Evercisegroup::getSlug( $row['evercisegroup_id'] ) , ['class' => 'blue-text']] ) }}
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
                <strong>Sub-total <span class="blue-text">{{ $cart['total']['subtotal'] }}</span></strong>
                @if($cart['total']['package_deduct'] > 0)
                    <strong>Package deduct: <span class="blue-text"> £{{ $cart['total']['package_deduct']  }}</span></strong>
                    <br>
                @endif
                @if($cart['total']['from_wallet'] > 0)
                    <strong>From Wallet: <span class="blue-text">£{{ $cart['total']['from_wallet']  }}</span></strong>
                    <br>
                @endif
                @if(!empty($cart['discount']['amount']) && $cart['discount']['amount'] > 0)
                    <strong>
                        Voucher discount: <span class="blue-text">- £{{ $cart['discount']['amount'] }}</span>
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




                    @foreach($cart['sessions_grouped'] as $row)
                        <?php
                            $date = new \Carbon\Carbon($row['date_time']);
                            $eg =  Evercisegroup::select('image', 'user_id')->where( 'id', $row['evercisegroup_id'])->first();
                            $directory = User::find($eg->user_id)->directory;
                            $image = $directory .'/thumb_'.$eg->image;
                        ?>
                        <li class="list-group-item bg-light-grey">
                            <div class="row">
                                <div class="col-sm-4">
                                    {{ image($image, $row['name'], ['class' => 'img-responsive']) }}
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12 mb5">
                                            <h3>{{ Html::linkRoute('class.show', $row['name'], [Evercisegroup::getSlug( $row['evercisegroup_id'] ) ] ) }}</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="pull-left">
                                                <span class="icon icon-clock"></span>{{ $date->toDayDateTimeString() }}
                                            </div>

                                            <div class="pull-left ml20"><span class="icon icon-watch"></span> {{$row['duration']}} mins</div>
                                            <div class="pull-left ml20"><span class="icon icon-ticket"></span> x {{$row['qty']}}</div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <strong class="text-primary">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>&pound;'.$row['grouped_price'].'</strike> &pound;'.$row['grouped_price_discount'] : '&pound;'.$row['grouped_price']) }}</strong>
                                        </div>
                                    </div>
                                    <div class="row mt20">
                                        <div class="col-sm-12">
                                            <span>
                                                <a href="{{ Share::load(URL::to('class/'.$row['evercisegroup_id'])  , $row['evercisegroup_id'])->facebook()  }}" target="_blank"><span class="icon icon-fb mr20 hover"></span> </a>
                                                <a href="{{ Share::load(URL::to('class/'.$row['evercisegroup_id'])  , $row['evercisegroup_id'])->twitter()  }}" target="_blank"><span class="icon icon-twitter mr20 hover"></span> </a>
                                                <a href="{{ Share::load(URL::to('class/'.$row['evercisegroup_id'])  , $row['evercisegroup_id'])->gplus()  }}" target="_blank"><span class="icon icon-google hover"></span> </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    @if(isset($cart['packages']))
                        @foreach($cart['packages'] as $row)
                            <li class="list-group-item bg-light-grey">
                                <div class="row">
                                    <div class="col-sm-4">
                                        image
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-12 mb5">
                                                <h3>{{ $row['name'] }}</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9">
                                                {{ $row['classes'] }} classes
                                            </div>
                                            <div class="col-sm-3 text-right">
                                                <strong class="text-primary">&pound;{{ $row['price'] }}</strong>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                    <li class="list-group-item bg-light-grey">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Sub-total <span class="text-primary ml15">{{ $cart['total']['subtotal'] }}</span></strong>
                            </div>
                            <div class="col-sm-6 text-right">
                                @if($cart['total']['package_deduct'] > 0)
                                    <strong>Package deduct: <span class="text-primary"> £{{ $cart['total']['package_deduct']  }}</span></strong>
                                    <br>
                                @endif
                                @if($cart['total']['from_wallet'] > 0)
                                    <strong>From Wallet: <span class="text-primary">£{{ $cart['total']['from_wallet']  }}</span></strong>
                                    <br>
                                @endif
                                @if(!empty($cart['discount']['amount']) && $cart['discount']['amount'] > 0)
                                    <strong>
                                        Voucher discount: <span class="text-primary ml15">- £{{ $cart['discount']['amount'] }}</span>
                                         @if($cart['discount']['type'] == 'percentage')
                                             <span class="text-primary ml15">{{ $cart['discount']['percentage']}}%</span>
                                         @endif
                                    </strong>
                                @endif
                            </div>
                        </div>
                    </li>
                    @if($cart['total']['final_cost'] > 0)
                        <li class="list-group-item bg-light-grey">
                            <div class="row">
                                <div class="col-sm-12">
                                    <strong>Total <span class="text-primary ml15">£{{$cart['total']['final_cost']}}</span></strong>
                                </div>
                            </div>
                        </li>
                    @endif
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-3 col-sm-offset-6">
                                {{ Html::linkRoute('home', 'Print', null, ['class' => 'btn btn-default btn-block']) }}
                            </div>
                            <div class="col-sm-3">
                                {{ Html::linkRoute('users.edit', 'View My Profile', [$user->display_name, 'wallet'], ['class' => 'btn btn-primary btn-block']) }}
                            </div>
                        </div>
                    </li>

<p>Remember to bring a water bottle, a towel or two and appropriate clothing.</p>
<p>If you have any questions, feel free to contact the instructor here.</p>
<p>Fitness is even more fun with friends! Click on the link below to share this class.</p>

{{ Html::decode(Html::linkRoute('users.edit', image('/assets/img/email/btns/btn_get_started.png', 'Get Started'), [$user->display_name], ['class' => 'btn btn-blue'])) }}

@stop