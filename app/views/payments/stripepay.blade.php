@extends('layouts.master')


@section('content')

<script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
          data-key="@stripeKey"
          data-amount="3" data-description="Evercise Sessions"></script>

@stop