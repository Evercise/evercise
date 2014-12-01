@extends('v3.layouts.master')
@section('body')

    <div class="container first-container">
        <div class="underline text-center">
            <h1>Complete</h1>
        </div>
        here is your data (awaiting design)
        <?php
            d($confirm, false);
            d($cart, false);
            d($payment_type, false);
            d($coupon, false);
            d($transaction, false);
            d($user, false);
            ?>
    </div>


@stop