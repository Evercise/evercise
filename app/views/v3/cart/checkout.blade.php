@extends('v3.layouts.master')
@section('body')
@include('v3.layouts.stripe_setup', ['route' => 'stripe.sessions'])
<script>
    var VIEWPRICE = '{{ isset($total['final_cost']) ? SessionPayment::poundsToPennies($total['final_cost'])  : null }}';
</script>
<div class="container">
    <div class="row">
        <div class="page-header col-sm-12">
            <h1 class="h2">Checkout</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 pull-right visible-sm-block visible-md-block visible-lg-block">
           <ul class="cart-progress sticky">
                <div id="progress-1" class="progress-box">
                <li class="title active"><span class="icon icon-cross mr10"></span>Review Order</li>
                </div>
                <div id="progress-2" class="progress-box">
                    <li class="content">Total <strong class="pull-right text-primary">£{{ number_format($total['final_cost'], 2,'.','') }}</strong></li>
                    <li class="title"><span class="icon icon-cross mr10"></span>Payment Method</li>
                </div>
                <div id="progress-3" class="progress-box">
                    <li class="content"></li>
                    <li class="title"><span class="icon icon-cross mr10"></span>Confirmation</li>
                </div>
           </ul>
        </div>
        <div class="col-sm-9">
            <ul class="checkout">

                 <div id="step-1" class="cart-step">
                    <li class="title active"><div class="col-sm-12">Review Order</div></li>
                    @include('v3.cart.checkout.step1')
                    <div class="mask hidden"><div class="loading"></div></div>
                 </div>
                 <hr class="dark">
                 <li class="text-right">
                    <a data-step="1" class="collapsed btn btn-white-primary continue sm-btn-block" data-toggle="collapse"  href="#step-2">Continue</a>
                 </li>

                 <li class="title"><div class="col-sm-12">Details & Payment</div></li>
                 @if(!isset($user))
                 <div id="step-2" class="cart-step collapse">
                     <div class="col-sm-10 col-sm-offset-1 mt25">
                        {{ Form::open(['id' => 'login-form', 'route' => 'auth.login.post', 'method' => 'post', 'class'=>'mb10 login-form', 'role' => 'form'] ) }}
                            {{ Form::hidden('redirect_after_login', 'true') }}
                            {{ Form::hidden('redirect_after_login_url', 'cart.checkout') }}
                            <div class="form-group">
                                <label for="email">What  is your Email Address?</label>
                                <div class="input-list">
                                    <div class="input-group mt10">
                                        <div class="input-group-addon"><strong>EMAIL</strong></div>
                                        {{ Form::email('email',null, ['class'=>'form-control input-lg', 'placeholder' => 'aname@address.com']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-divider mb15">or</div>
                            {{ Html::linkRoute('users.fb', 'Connect via Facebook', null, ['class' => 'custom-fb mb15']) }}
                            <label for="account">Do you have a Evercise account?</label>
                            <div class="input-list">
                                 <div class="custom-checkbox form-control input-lg mt10 input-group">
                                    {{ Form::checkbox('new', 'yes', true , ['id'=> 'new']) }}
                                    <label for="new" >I'm a new customer</label>
                                 </div>
                                 <div class="input-group">
                                     <div class="input-group-addon">
                                        <div class="custom-checkbox">
                                            {{ Form::checkbox('ps', 'yes', false , ['id'=> 'ps']) }}
                                            <label for="ps" >Yes I have a Password:</label>
                                        </div>
                                     </div>
                                     {{ Form::password('password',['class' => 'form-control input-lg']) }}
                                 </div>
                            </div>
                            <div class="pull-right mt15">
                                {{ HTML::linkRoute('auth.forgot', 'Forgot your Password?' , null, ['class' => 'text-right link']) }}
                            </div>
                        {{Form::close()}}
                        {{ Form::open(['route' => 'users.guest.store', 'method' => 'post', 'class'=>'mb50', 'role' => 'form', 'id' => 'new-user-form'] ) }}
                            {{ Form::hidden('email',null, ['class'=>'form-control input-lg', 'placeholder' => 'aname@address.com']) }}
                        {{ Form::close() }}
                        <li class="text-right">
                            {{ Form::button('Continue', ['class' => 'btn btn-white-primary', 'id' => 'cart-account']) }}
                        </li>




                     </div>
                 </div>
                 @else
                 <div id="step-2" class="cart-step collapse">
                     <div class="col-sm-8 col-sm-offset-2 text-center mt30">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                Welcome back, mewis (<a href="{{ URL::route('auth.logout') }}" class="link">not you?</a>), how would you like to pay?
                                <div class="mt10">
                                    <strong class="text-largest">Pay with:</strong>
                                </div>
                                <div class="row mt20">
                                    <div class="col-xs-6"><button  id="fb-pay" class="btn btn-paypal btn-block" onclick="window.location = '{{ URL::route('payment.request.paypal') }}'">Pay with paypal</button></div>
                                    <div class="col-xs-6"><button id="stripe-button" class="btn btn-primary btn-block">Pay with card</button></div>
                                </div>
                            </div>
                        </div>

                     </div>
                 </div>
                 @endif
                 <li class="title mb50"><div class="col-sm-12">Confirmation</div></li>
            </ul>
        </div>

    </div>
</div>
@stop