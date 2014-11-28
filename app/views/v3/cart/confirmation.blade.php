@extends('v3.layouts.master')
@section('body')

    <br>
    <div class="container mt30">
        <h2>Confirmation</h2>
    </div>
    <?php
    d($confirm, false); 
    d($cart, false); 
    d($payment_type, false); 
    d($coupon, false);
    d($transaction, false); 
    d($user, false);
    ?>

@stop