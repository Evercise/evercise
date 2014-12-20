<div class="container-fluid bg-grey">
    @include('v3.layouts.stripe_setup', ['route' => 'stripe.topup'])
    <div class="container">
        <div class="underline text-center">
            <h1>Wallet</h1>
        </div>
        <div id="" class="row">
            <div class="col-md-6">
                <ul class="list-group mb20">

                  <li class="list-group-item ">
                    <div class="row">
                        <div class="col-sm-7 sm-mb10">
                            <h3>Current Balance: <span class="text-primary">£{{round($data['user']->getWallet()->getBalance(), 2)}}</span> </h3>
                        </div>
                        @if($data['user']->getWallet()->balance > 0)
                        <div class="col-sm-5 text-right">
                            {{ Form::open(['route' => 'ajax.request.withdrawal', 'method' => 'post', 'id' => 'withdraw-funds']) }}
                                {{ Form::submit('Withdraw Funds', ['class' => 'btn btn-default sm-btn-block']) }}
                            {{Form::close()}}
                        </div>
                        @endif
                    </div>
                  </li>
                  {{ Form::open(['id' => 'add-topup', 'route' => 'cart.add', 'method' => 'post', 'class' => '']) }}
                      <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-12">
                                <strong>How much would you like to top up?</strong>
                            </div>
                        </div>
                        <div class="row mt20">
                            <div class="col-sm-2 sm-mb10">
                                <div class="btn-group btn-block">
                                    <button data-amount="10" class="btn btn-default btn-sm btn-block add-btn" type="button">&pound;10</button>
                                </div>
                            </div>
                            <div class="col-sm-2 sm-mb10">
                                <div class="btn-group btn-block">
                                    <button data-amount="25" class="btn btn-default btn-sm btn-block add-btn" type="button">&pound;25</button>
                                </div>
                            </div>
                            <div class="col-sm-2 sm-mb10">
                                <div class="btn-group  btn-block">
                                    <button data-amount="50" class="btn btn-default btn-sm btn-block add-btn" type="button">&pound;50</button>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {{ HTML::decode( Form::text('custom', null, ['class' => 'form-control input-sm', 'placeholder' => '&pound Custom amount' ]) )  }}

                                {{ Form::hidden( 'product-id' , 'T', array('id' => 'product-id')) }}
                                {{ Form::hidden( 'amount' , 0 , array('id' => 'amount')) }}
                            </div>
                        </div>

                      </li>
                      <li id="topup-option" class="list-group-item">
                        <div class="row">
                            <div class="col-sm-5 sm-mb10">
                                {{ Html::linkRoute('payment.request.paypal.topup', 'Pay with paypal', null,  ['class' =>'btn btn-info btn-block', 'id' =>'fb-pay']) }}
                            </div>
                            <div class="col-sm-2 text-center mt5 hidden-mob">
                                Or
                            </div>
                            <div class="col-sm-5">
                                <button id="stripe-button" class="btn btn-primary btn-block">Pay with card</button>
                            </div>
                        </div>
                      </li>
                  {{ Form::close() }}
                </ul>
                <ul class="list-group">

                  <li class="list-group-item ">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Add to your balance</h3>
                        </div>
                    </div>
                  </li>
                  <li class="list-group-item ">
                    <div class="row">
                        <div class="col-sm-12">
                            <strong>Refer a friend</strong>
                            <p>Enter a friends email address below and they&apos;ll be sent a referral code. If they then register with Evercise using the referral code, You&apos;ll both get a £5.00 reward.
                            </p>
                            <div class="form-group row mt20">
                                {{ Form::open(['url' => 'new_referral', 'method' => 'post', 'class'=>'', 'role' => 'form', 'id' => 'refer-a-friend'] ) }}
                                    {{ Form::label('email', 'Email' , ['class' => 'mt5 col-sm-2 control-label'])  }}
                                    <div class="col-sm-7 sm-mb10">
                                        {{ Form::text('referee_email', null, ['class' => 'form-control', 'placeholder' => 'Enter Friends Email Address']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::submit('Invite', ['class' => 'btn btn-primary btn-block']) }}
                                    </div>
                                {{ Form::close() }}
                            </div>
                            <div class="form-group row mt20">
                                <div class="col-sm-12">
                                    <strong>Pending referrals: <span id="referral-amount" class="text-primary">{{$data['user']->countPendingReferrals()}}</span></strong>
                                    <strong>Friends referred: <span id="referral-amount" class="text-primary">{{$data['user']->milestone->showReferrals()}}</span></strong>
                               </div>
                            </div>
                        </div>
                    </div>

                  </li>
                  <li class="list-group-item ">
                    <div class="row">
                      @if(! $data['user']->hasFacebook())
                            <div class="col-sm-7 mt10 sm-mb10">
                                <strong><span class="text-primary">£{{ number_format(Config::get('values.milestones.facebook.reward'),2) }}</span> FREE when you link to Facebook</strong>
                            </div>
                            <div class="col-sm-5">
                                {{ HTML::decode(HTML::linkRoute('tokens.fbtoken', '<span class="icon icon-fb-white"></span>Link Account', null , ['class' => 'btn btn-lg btn-fb btn-block']) )}}
                            </div>
                        @else
                            <div class="col-sm-12 mt10">
                                <strong>Thanks for linking your Facebook account</strong>
                            </div>
                        @endif
                     </div>
                  </li>
                  <li class="list-group-item ">
                      <div class="row">
                      @if(! $data['user']->hasTwitter())
                          <div class="col-sm-7 mt10 sm-mb10">
                              <strong><span class="text-primary">£{{ number_format(Config::get('values.milestones.twitter.reward'),2) }}</span> FREE when you link to Twitter</strong>
                          </div>
                          <div class="col-sm-5">
                              {{ HTML::decode(HTML::linkRoute('twitter', '<span class="icon icon-twitter-white"></span>Link Account', null , ['class' => 'btn btn-lg btn-twitter btn-block']) )}}
                          </div>
                        @else
                            <div class="col-sm-12 mt10">
                                <strong>Thanks for linking your Twitter account</strong>
                            </div>
                        @endif
                      </div>
                  </li>

                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group">

                      <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-8">
                                <h3>Transactions</h3>
                            </div>
                            <!--
                            <div class="col-sm-4">
                                <div class="input-group">
                                   <span class="input-group-addon">
                                        <span class="icon icon-calendar ml5 mr5"></span>
                                   </span>
                                   <div class="custom-select">
                                      {{ Form::select('date',
                                          [
                                              '01' => 'January',
                                              '02' => 'Febuary',
                                          ]
                                       , '01', ['class' => 'form-control no-border-left custom-select'] ) }}
                                   </div>
                                </div>
                            </div>
                            -->
                        </div>
                      </li>
                      <!--
                      <li class="list-group-item ">
                        <ul class="nav nav-pills nav-justified">
                          <li class="active"><a href="#">All</a></li>
                          <li><a href="#">Transactions In</a></li>
                          <li><a href="#">Transactions Out</a></li>
                        </ul>
                      </li>
                        -->
                      <li class="list-group-item hidden-mob">
                        <div class="row">
                            <div class="col-sm-4">
                                <strong>Date</strong>
                            </div>
                            <div class="col-sm-6">
                                <strong>Description of Transaction</strong>
                            </div>
                            <div class="col-sm-2 text-right">
                                <strong>Amount</strong>
                            </div>
                        </div>
                      </li>

                      @foreach($data['user']->activities()->whereIn('type', Config::get('evercise.transaction_types'))->orderBy('id', 'desc')->get() as $act)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">
                                    <span class="icon icon-calendar mr5"></span><span>{{ date('M jS Y' , strtotime($act->created_at))}}</span>
                                </div>
                                <div class="col-sm-6">
                                    {{$act->title}}
                                </div>
                                <div class="col-sm-2 text-right">
                                    £{{number_format($act->transaction ? $act->transaction['total'] : '0.00', 2)}}
                                </div>
                            </div>
                        </li>
                      @endforeach


                      <li class="list-group-item text-right">
                        <!-- <strong>Show More </strong>
                        <span class="pull-right ml5 icon icon-grey-down-arrow"></span> -->
                      </li>


                </ul>
            </div>

            <div class="col-md-6">

            </div>
        </div>
    </div>
</div>

