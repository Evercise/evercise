<div class="container-fluid bg-grey">
    <div class="container">
        <div class="underline text-center">
            <h1>Wallet</h1>
        </div>
        <div id="masonry" class="row masonry">
            <div class="col-md-6 masonry-item">
                <ul class="list-group">
                    {{ Form::open(['url' => '', 'method' => 'post', 'class'=>'', 'role' => 'form'] ) }}
                      <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-8">
                                <h3>Current Balance: <span class="text-primary">£16.00</span> </h3>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-default btn-block">Cancel</button>
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
                                <button class="btn btn-primary btn-sm btn-block">&pound;10</button>
                            </div>
                            <div class="btn-group col-sm-2">
                                <button class="btn btn-light-grey btn-transparent btn-sm btn-block">&pound;25</button>
                            </div>
                            <div class="btn-group col-sm-2">
                                <button class="btn btn-light-grey btn-transparent btn-sm btn-block">&pound;50</button>
                            </div>
                            <div class="btn-group col-sm-6">
                                {{ HTML::decode( Form::text('custom', null, ['class' => 'form-control input-sm', 'placeholder' => '&pound Custom amount' ]) )  }}
                            </div>
                        </div>

                      </li>
                      <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-12">
                                <strong>Have a voucher to redeem?</strong>
                            </div>
                            <div class="col-sm-12 mt20">
                               {{ Form::text('voucher', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Voucher Code']) }}
                            </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-5">
                                <button class="btn btn-info btn-block">Pay with paypal</button>
                            </div>
                            <div class="col-sm-2 text-center mt5">
                                Or
                            </div>
                            <div class="col-sm-5">
                                <button class="btn btn-primary btn-block">Pay with Credit Card</button>
                            </div>
                        </div>
                      </li>
                    {{ Form::close() }}
                </ul>
            </div>
            <div class="col-md-6 masonry-item">
                <ul class="list-group">
                    {{ Form::open(['url' => '', 'method' => 'post', 'class'=>'', 'role' => 'form'] ) }}
                      <li class="list-group-item ">
                        <div class="row">
                            <div class="col-sm-8">
                                <h3>Transactions</h3>
                            </div>
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
                        </div>
                      </li>
                      <li class="list-group-item ">
                        <ul class="nav nav-pills nav-justified">
                          <li class="active"><a href="#">All</a></li>
                          <li><a href="#">Transactions In</a></li>
                          <li><a href="#">Transactions Out</a></li>
                        </ul>
                      </li>

                      <li class="list-group-item">
                        <div class="row">
                            <table class="table table-condensed mb0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description of Purchase</th>
                                        <th class="text-right">Cost</th>
                                    </tr>

                               <tbody>
                                    <tr>
                                        <td class="transparent-border-top">29/09/14</td>
                                        <td>Fitness Class for Ladies</td>
                                        <td class="text-right">-&pound;16.00</td>
                                    </tr>
                                    <tr>
                                        <td class="transparent-border-top">31/09/14</td>
                                        <td>Top up via Paypal</td>
                                        <td class="text-right text-success">&pound;20.00</td>
                                    </tr>
                                    <tr>
                                        <td class="transparent-border-top">29/09/14</td>
                                        <td>Upside down Zumba</td>
                                        <td class="text-right">-&pound;9.00</td>
                                    </tr>
                               </tbody>
                            </table>
                        </div>
                      </li>
                      <li class="list-group-item text-right">
                        <strong>Show More </strong>
                        <span class="pull-right ml5 icon icon-grey-down-arrow"></span>
                      </li>
                    {{ Form::close() }}
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
                            <p>Enter a friends email address below and tey&apos;ll be sent a referral code. If they then register with Evercise using the referral code, they&apos;ll count towards your 500 Evercoin total. They will also recieve a evercoin for using your referral
                            </p>
                            <div class="form-group row mt20">
                                {{ Form::open(['url' => '', 'method' => 'post', 'class'=>'', 'role' => 'form'] ) }}
                                    {{ Form::label('email', 'Email' , ['class' => 'mt5 col-sm-2 control-label'])  }}
                                    <div class="col-sm-7">
                                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Friends Email Address']) }}
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary btn-block">Invite</button>
                                    </div>
                                {{ Form::close() }}
                            </div>
                            <div class="form-group row mt20">
                                <div class="col-sm-12">
                                    <strong>Friends reffered: <span class="text-primary">0/3</span></strong>
                               </div>
                            </div>
                        </div>
                    </div>

                  </li>
                  <li class="list-group-item ">
                    <div class="row">
                        <div class="col-sm-7 mt10">
                            <strong><span class="text-primary">&pound;5</span> FREE when you link to Facebook</strong>
                        </div>
                        <div class="col-sm-5">
                            {{ HTML::decode(HTML::linkRoute('users.fb', '<span class="icon icon-fb"></span>Link Account', null , ['class' => 'btn btn-lg btn-fb btn-block']) )}}
                        </div>
                    </div>
                  </li>
                  <li class="list-group-item ">
                      <div class="row">
                          <div class="col-sm-7 mt10">
                              <strong><span class="text-primary">&pound;5</span> FREE when you link to Twitter</strong>
                          </div>
                          <div class="col-sm-5">
                              {{ HTML::decode(HTML::linkRoute('users.fb', '<span class="icon icon-twitter"></span>Link Account', null , ['class' => 'btn btn-lg btn-twitter btn-block']) )}}
                          </div>
                      </div>
                  </li>

                </ul>
            </div>
        </div>
    </div>
</div>

