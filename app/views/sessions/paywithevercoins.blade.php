<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Pay with Evercoins</h4>
		<br>
	</div>
	<div>
		{{ $evercoins }}
	</div>

	<div class="modal-body">
		{{ Form::open(array('id' => 'paywithevercoins', 'url' => 'sessions/'.$session->id.'/paywithevercoins', 'method' => 'POST', 'class' => 'create-form')) }}

			{{ Form::submit('Pay' , array('class'=>'btn-yellow ')) }}

        	<div class="success_msg">Paid Successfully</div>

		{{ Form::close() }}
    </div>
</div>