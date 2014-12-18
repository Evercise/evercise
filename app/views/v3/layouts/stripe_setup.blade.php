<script src="https://checkout.stripe.com/checkout.js"></script>

<script>
  var handler = StripeCheckout.configure({
    key: "{{  ( Config::get('evercise.stripe_testing') ? Config::get('evercise.stripe_api_key_test') : Config::get('evercise.stripe_api_key_test') ) }}",
    image: '{{url()}}/img/evercoin.png',
    currency: "gbp",
    token: function(token) {
      $('#stripe-form').find('input[name="stripeToken"]').val(token.id);
      $('#stripe-form').trigger('submit');
    }
  });

</script>
{{ Form::open(['id' => 'stripe-form', 'route' => $route , 'method' => 'post', 'class' => '']) }}
    {{ Form::hidden('stripeToken', null) }}
{{ Form::close() }}