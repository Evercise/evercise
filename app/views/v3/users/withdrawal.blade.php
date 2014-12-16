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
            {{ Form::open(['route' => 'ajax.process.withdrawal', 'method'=>'post', 'id' => 'request-withdrawal-form']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('paypal', 'Enter your paypal email') }}
                        {{ Form::text('paypal', $user->paypal_email, ['class' => 'form-control', 'placeholder' => 'your paypal email']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('amount', 'The amount you wish to withdraw') }}
                        {{ Form::number('amount', round($wallet->balance,2), ['class' => 'form-control', 'placeholder' => 'Amount to withdraw']) }}
                        <p class="help-block mb40">MAX: £{{ round($wallet->balance,2) }}</p>

                    </div>
                    <div class="text-center col-sm-12">
                        {{ Form::submit('Request', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>



            {{ Form::close() }}
      </div>
    </div>
  </div>
</div>