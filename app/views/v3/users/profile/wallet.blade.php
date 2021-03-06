<div class="container-fluid bg-grey">
    @include('v3.layouts.stripe_setup', ['route' => 'stripe.topup'])
    <div class="container">
        <div class="underline text-center">
            <h1>Wallet</h1>
        </div>
        <div id="" class="row">
            <div class="col-md-6">

                @if($data['user']->isTrainer())
                <ul class="list-group mb20">
                    <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-7 sm-mb10">
                                <h3>Current Balance: <span class="text-primary">£{{round($data['user']->getWallet()->getBalance(), 2)}}</span> </h3>
                            </div>
                            @if($data['user']->getWallet()->balance > 5 && $data['user']->isTrainer())
                                <div class="col-sm-5 text-right">
                                    {{ Form::open(['route' => 'ajax.request.withdrawal', 'method' => 'post', 'id' => 'withdraw-funds']) }}
                                    {{ Form::submit('Withdraw Funds', ['class' => 'btn btn-default sm-btn-block']) }}
                                    {{Form::close()}}
                                </div>
                            @endif
                        </div>
                    </li>
                    @if(count($data['user']->pendingWithdrawals))
                    <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-12">
                                @foreach($data['user']->pendingWithdrawals as $pw)
                                    <div><strong>Pending withdrawal: </strong><span  class="text-primary">£{{round($pw->transaction_amount, 2)}}</span> on <span  class="text-primary">{{ date('M jS Y' , strtotime($pw->created_at)) }}</span></div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-12">
                                    <div>Withdrawal requests are processed every Monday.</div>
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
                @endif

                <ul class="list-group">

                  <li class="list-group-item ">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Rewards</h3>
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

