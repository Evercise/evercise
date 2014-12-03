<div class="container-fluid bg-grey">
    @include('v3.layouts.stripe_setup', ['route' => 'stripe.topup'])
    <div class="container">
        <div class="underline text-center">
            <h1>Wallet</h1>
        </div>
        <div id="masonry" class="row masonry">
            <div class="col-md-6 masonry-item">
                <ul class="list-group">
                  {{ Form::open(['id' => 'add-topup', 'route' => 'cart.add', 'method' => 'post', 'class' => '']) }}
                      <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-8">
                                <h3>Current Balance: <span class="text-primary">£{{round($data['user']->getWallet()->getBalance(), 2)}}</span> </h3>
                            </div>
                            <div class="col-sm-4">
                                <button id="cancel-btn" class="btn btn-default btn-block">Cancel</button>
                            </div>
                        </div>
                      </li>
                      <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-12">
                                <strong>How much would you like to top up?</strong>
                            </div>
                        </div>
                        <div class="row mt20 sm-inline-gutter">
                            <div class="btn-group col-sm-2">
                                <button data-amount="10" class="btn btn-default btn-sm btn-block add-btn" type="button">&pound;10</button>
                            </div>
                            <div class="btn-group col-sm-2">
                                <button data-amount="25" class="btn btn-default btn-sm btn-block add-btn" type="button">&pound;25</button>
                            </div>
                            <div class="btn-group col-sm-2">
                                <button data-amount="50" class="btn btn-default btn-sm btn-block add-btn" type="button">&pound;50</button>
                            </div>
                            <div class="btn-group col-sm-6">
                                {{ HTML::decode( Form::text('custom', null, ['class' => 'form-control input-sm', 'placeholder' => '&pound Custom amount' ]) )  }}

                                {{ Form::hidden( 'product-id' , 'T', array('id' => 'product-id')) }}
                                {{ Form::hidden( 'amount' , 0 , array('id' => 'amount')) }}
                            </div>
                        </div>

                      </li>
                      <li id="topup-option" class="list-group-item">
                        <div class="row">
                            <div class="col-sm-5">
                                <button id="fb-pay" class="btn btn-info btn-block">Pay with paypal</button>
                            </div>
                            <div class="col-sm-2 text-center mt5">
                                Or
                            </div>
                            <div class="col-sm-5">
                                <button id="stripe-button" class="btn btn-primary btn-block">Pay with card</button>
                            </div>
                        </div>
                      </li>
                  {{ Form::close() }}
                </ul>
            </div>
            <div class="col-md-6 masonry-item">
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
                      <li class="list-group-item">
                        <div class="row">
                            <table class="table table-condensed mb0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description of Transaction</th>
                                        <th class="text-right">Cost</th>
                                    </tr>

                               <tbody>
                                   @foreach($data['user']->activities as $act)
                                        <tr>
                                            <td class="transparent-border-top">{{$act->created_at}}</td>
                                            <td>{{$act->description}}</td>
                                            <td class="text-right">{{isset($act->transaction) ? $act->transaction->total : 0}}</td>
                                        </tr>
                                    @endforeach
                               </tbody>
                            </table>
                        </div>
                      </li>

                      <li class="list-group-item text-right">
                        <!-- <strong>Show More </strong>
                        <span class="pull-right ml5 icon icon-grey-down-arrow"></span> -->
                      </li>


                </ul>
            </div>

            <div class="col-md-6 masonry-item">
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
                            <p>Enter a friends email address below and they&apos;ll be sent a referral code. If they then register with Evercise using the referral code, they&apos;ll count towards your 500 Evercoin total. They will also recieve a evercoin for using your referral
                            </p>
                            <div class="form-group row mt20">
                                {{ Form::open(['url' => 'new_referral', 'method' => 'post', 'class'=>'', 'role' => 'form', 'id' => 'refer-a-friend'] ) }}
                                    {{ Form::label('email', 'Email' , ['class' => 'mt5 col-sm-2 control-label'])  }}
                                    <div class="col-sm-7">
                                        {{ Form::text('referee_email', null, ['class' => 'form-control', 'placeholder' => 'Enter Friends Email Address']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        {{ Form::submit('Invite', ['class' => 'btn btn-primary btn-block']) }}
                                    </div>
                                {{ Form::close() }}
                            </div>
                            <div class="form-group row mt20">
                                <div class="col-sm-12">
                                    <strong>Friends referred: <span class="text-primary">{{$data['user']->milestone->showReferrals()}}</span></strong>
                               </div>
                            </div>
                        </div>
                    </div>

                  </li>
                  <li class="list-group-item ">
                    <div class="row">
                      @if(! $data['user']->hasFacebook())
                            <div class="col-sm-7 mt10">
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
                          <div class="col-sm-7 mt10">
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
        </div>
    </div>
</div>

