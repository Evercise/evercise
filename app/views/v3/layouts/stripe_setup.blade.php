<script src="https://checkout.stripe.com/checkout.js"></script>

<script>
  var handler = StripeCheckout.configure({
    key: "@stripeKey",
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