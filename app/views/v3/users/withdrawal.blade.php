<div class="modal fade" id="request-withdrawal" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal"><span class="icon icon-cross" aria-hidden="true"></span><span class="sr-only">Close</span></button>
        <h3 class="modal-title text-center">Withdraw money </h3>
        @if(time() > strtotime($payment_date))
            <small>Next payment processing is on {{ date('M dS, h:ia', strtotime('next '.$payment_date)) }} </small>
        @else
            <small>Next payment processing is on {{ date('M dS, h:ia', strtotime($payment_date)) }} </small>
        @endif
      </div>
      <div class="modal-body text-left">
            {{ Form::open(['route' => 'ajax.process.withdrawal', 'method'=>'post']) }}

                {{ Form::text('paypal', $user->paypal_email) }}
                {{ Form::number('amount', 1) }} MAX: {{ number_format($wallet->balance,2) }}
                {{ Form::submit('Request') }}

            {{ Form::close() }}
      </div>
    </div>
  </div>
</div>