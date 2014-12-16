@extends('v3.layouts.master')
@section('body')

    <div class="container first-container">
        <div class="row">
            <div class="underline text-center">
                <h1>Transaction Complete</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-6">

                                <h2 class="mt0 mb0">Your order</h2>
                                <strong>Order Number: {{ $transaction }}</strong>


                            </div>
                            <div class="col-sm-6 text-right mt20">
                                <h3>current balance: <span class="text-primary">£{{round($balance, 2)}}</span> </h3>
                            </div>
                        </div>
                    </li>

                    @foreach($cart['sessions_grouped'] as $row)
                        <?php
                            $date = new \Carbon\Carbon($row['date_time']);
                            $eg =  Evercisegroup::select('image', 'user_id')->where( 'id', $row['evercisegroup_id'])->first();
                            $directory = User::find($eg->user_id)->directory;
                            $image = $directory .'/preview_'.$eg->image;
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
                                            <strong class="text-primary">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>&pound'.$row['grouped_price'].'</strike> &pound'.$row['grouped_price_discount'] : '&pound'.$row['grouped_price']) }}</strong>
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
                                        {{ image('assets/img/activity/Activity_Joined_Evercise.png', 'package', ['class' => 'img-responsive']) }}
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
                                <strong>Sub-total <span class="text-primary ml15">£{{ round($cart['total']['subtotal'], 2) }}</span></strong>
                            </div>
                            <div class="col-sm-6 text-right">
                                @if($cart['total']['package_deduct'] > 0)
                                    <strong>Package deduct: <span class="text-primary"> £{{ round($cart['total']['package_deduct'], 2)  }}</span></strong>
                                    <br>
                                @endif
                                @if($cart['total']['from_wallet'] > 0)
                                    <strong>From Wallet: <span class="text-primary">£{{round( $cart['total']['from_wallet'], 2)  }}</span></strong>
                                    <br>
                                @endif
                                @if(!empty($cart['discount']['amount']) && $cart['discount']['amount'] > 0)
                                    <strong>
                                        Voucher discount: <span class="text-primary ml15">- £{{ round($cart['discount']['amount'], 2) }}</span>
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
                                    <strong>Total <span class="text-primary ml15">£{{ round($cart['total']['final_cost'], 2)}}</span></strong>
                                </div>
                            </div>
                        </li>
                    @endif
                    <li class="list-group-item">
                        <div class="row">
                            <!--div class="col-sm-3 col-sm-offset-6">
                                {{-- Html::linkRoute('home', 'Print', null, ['class' => 'btn btn-default btn-block']) --}}
                            </div-->
                            <div class="col-sm-3">
                                {{ Html::linkRoute('users.edit', 'View My Profile', [$user->display_name, 'wallet'], ['class' => 'btn btn-primary btn-block']) }}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>


@stop