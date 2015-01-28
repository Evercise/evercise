@extends('v3.layouts.master')
@section('body')

    <div class="container">
        <div class="row">
            <div class="page-header col-sm-12">
                <h1 class="h2">Checkout</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <ul class="checkout">
                    <li class="title active"><div class="col-sm-12">Confimation</div></li>
                    <!-- http://evercise.dev/files/u/1/19/preview_brazilian-forro-dance-class-17.jpg -->
                </ul>
                <strong>Order ID: 89329742</strong>
                <p>Thanks for your order! You can view your classes at any time through you account.</p>
            </div>
            <div class="col-sm-3">
               <ul class="cart-progress">
                    <li class="title active"><span class="icon icon-cross mr10"></span>Review Order</li>
                    <div class="complete">
                        <li class="content">Total <strong class="pull-right text-primary">£23.99</strong></li>
                        <li class="title"><span class="icon icon-cross mr10"></span>Payment Method</li>
                    </div>
                    <div class="complete">
                        <li class="content"></li>
                        <li class="title"><span class="icon icon-cross mr10"></span>Confirmation</li>
                    </div>
               </ul>
            </div>
        </div>


    </div>


@stop