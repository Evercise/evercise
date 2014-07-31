<div class='modal tc'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Problem with this class</h4>
		<h5>{{ $session->evercisegroup->name}} - {{ date('h:ia d-M-y' , strtotime($session->date_time))}}</h5>
	</div>

    <div class="modal-body">	
    	<p>Please let us know the nature of your request and<br> we will get back to you within 5 woking days</p>
		{{ Form::open(array('id' => 'mail_one_refund', 'url' => 'sessions/'.$session->id.'/refund', 'method' => 'POST', 'class' => 'create-form  mt20')) }}
		
	    	@include('form.textfield', array('fieldname'=>'mail_subject', 'placeholder'=>'Type your subject here', 'maxlength'=>1000, 'label'=>'Subject', 'fieldtext'=>''))
	        @if ($errors->has('mail_subject'))
	            {{ $errors->first('mail_subject', '<p class="error-msg">:message</p>')}}
	        @endif

	    	@include('form.textarea', array('fieldname'=>'mail_body', 'placeholder'=>'Type your mail here', 'maxlength'=>1000, 'label'=>'Mail body', 'fieldtext'=>''))
	        @if ($errors->has('mail_body'))
	            {{ $errors->first('mail_body', '<p class="error-msg">:message</p>')}}
	        @endif

	        <div class="modal-footer">
	        	{{ Form::submit('Send Message' , array('class'=>'btn-yellow button')) }}
	        </div>

			

        	<div class="success_msg">Message sent</div>

		{{ Form::close() }}
    </div>
</div>