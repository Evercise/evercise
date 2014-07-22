<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Email your trainer {{ $name }} regarding {{ $groupName }} at {{ date('h:m', strtotime($dateTime)) }} on {{ date('d-M-Y', strtotime($dateTime)) }}</h4>
		<br>
	</div>
	
	<div class="modal-body">
		{{ Form::open(array('id' => 'mail_trainer', 'url' => 'sessions/'.$sessionId.'/mail_trainer/'.$trainerId, 'method' => 'POST', 'class' => 'create-form')) }}
		
	    	@include('form.textfield', array('fieldname'=>'mail_subject', 'placeholder'=>'Type your subject here', 'maxlength'=>1000, 'label'=>'Subject', 'fieldtext'=>''))
	        @if ($errors->has('mail_subject'))
	            {{ $errors->first('mail_subject', '<p class="error-msg">:message</p>')}}
	        @endif

	    	@include('form.textfield', array('fieldname'=>'mail_body', 'placeholder'=>'Type your mail here', 'maxlength'=>1000, 'label'=>'Mail body', 'fieldtext'=>''))
	        @if ($errors->has('mail_body'))
	            {{ $errors->first('mail_body', '<p class="error-msg">:message</p>')}}
	        @endif

			{{ Form::submit('Send Email' , array('class'=>'btn-yellow button')) }}

        	<div class="success_msg">Message sent</div>

		{{ Form::close() }}
    </div>

</div>