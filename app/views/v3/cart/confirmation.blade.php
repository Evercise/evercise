@extends('v3.layouts.master')
@section('body')

    <div class="container">
        <div class="row">
            <div class="page-header col-sm-12">
                <h1 class="h2">Checkout</h1>
            </div>
        </div>
        <div class="row mb40">
            <div class="col-sm-9">
                <ul class="checkout">
                    <li class="title active mb10"><div class="col-sm-12">Confimation</div></li>
                </ul>
                <strong>Order ID: {{ $transaction }}</strong>

                <p>Thanks for your order! You can view your classes at any time through you account.</p>
                @foreach($cart['sessions_grouped'] as $row)
                    <?php

                        $eg =  Evercisegroup::select('image', 'user_id')->where( 'id', $row['evercisegroup_id'])->first();
                        $directory = User::find($eg->user_id)->directory;
                        $image = $directory .'/preview_'.$eg->image;
                    ?>
                    <div class="row mb20">
                        <div class="col-sm-4">
                            {{ image($image, $row['name'], ['class' => 'img-rounded img-responsive']) }}
                        </div>
                        <div class="col-sm-8 ">
                            <div class="text-sm mt5 text-light-grey">
                                <b>{{ Html::linkRoute('class.show', $row['name'], [Evercisegroup::getSlug( $row['evercisegroup_id'] ) ] ) }}</b><br>
                                {{ date('D, j F Y g:i A', strtotime($row['date_time']))}}<br>
                                QTY: {{$row['qty']}}<br>
                            </div>
                            <strong class="text-primary text-larger">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>&pound'.$row['grouped_price'].'</strike> &pound'.$row['grouped_price_discount'] : '&pound'.$row['grouped_price']) }}</strong>
                            <div class="mt5">
                                <strong>Share this Class</strong>
                                <div class="mt5">
                                    <a href="{{ Share::load(URL::to('class/'.Evercisegroup::getSlug( $row['evercisegroup_id'] ))  , $row['evercisegroup_id'])->facebook()  }}" target="_blank"><span class="icon icon-fb mr40 hover"></span> </a>
                                    <a href="{{ Share::load(URL::to('class/'.Evercisegroup::getSlug( $row['evercisegroup_id'] ))  , $row['evercisegroup_id'])->twitter()  }}" target="_blank"><span class="icon icon-twitter mr40 hover"></span> </a>
                                    <a href="{{ Share::load(URL::to('class/'.Evercisegroup::getSlug( $row['evercisegroup_id'] ))  , $row['evercisegroup_id'])->gplus()  }}" target="_blank"><span class="icon icon-google mr40 hover"></span> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <ul class="checkout">
                    <hr class="dark">
                    <li class="item mb20">
                        <div class="row">
                            <div class="col-sm-6">Total</div>
                            <div class="col-sm-6 text-right"><strong class="text-primary text-largest">£{{ number_format($cart['total']['final_cost'], 2, '.', '')}}</strong></div>
                        </div>
                    </li>
                    <li class="item">
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                {{ Html::linkRoute('users.edit', 'View my Account', $user->display_name , ['class' => 'btn btn-primary btn-block']) }}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-sm-3">
               <ul class="cart-progress">
                    <li class="title active"><span class="icon icon-cross mr10"></span>Review Order</li>
                    <div class="complete">
                        <li class="content">Total <strong class="pull-right text-primary">£{{ number_format($cart['total']['final_cost'], 2, '.', '')}}</strong></li>
                        <li class="title"><span class="icon icon-cross mr10"></span>Payment Method</li>
                    </div>
                    <div class="complete">
                        <li class="content"></li>
                        <li class="title"><span class="icon icon-cross mr10"></span>Confirmation</li>
                    </div>
                    <b>Thanks for your purchase!</b><br>
                    <b>Order ID: {{ $transaction }}</b>
               </ul>
            </div>
        </div>


    </div>


@stop