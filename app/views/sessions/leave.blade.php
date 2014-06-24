<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Leave Session</h4>
		<br>
	</div>

	@if ( $status == 2 )
		<p>This session will take place in more than 5 days, so you can recieve a full refund in Evercoins.</p>
	@elseif( $status == 1 )
		<p>This class will take place in more than 2 days, so you can still recieve a 50% refund in Evercoins.</p>
	@elseif( $status == 0 )
		<p>This class will take place in less than 2 days, so you can no longer recieve a refund.</p>
	@endif
	@if( $status > 0 )
		<div class="modal-body">
			{{ Form::open(array('id' => 'leave', 'url' => 'sessions/'.$session->id.'/leave', 'method' => 'POST', 'class' => 'create-form')) }}

				{{ Form::submit('Leave Session' , array('class'=>'btn-yellow ')) }}

	        	<div class="success_msg">Left Successfully</div>

			{{ Form::close() }}
	    </div>
	@endif
</div>