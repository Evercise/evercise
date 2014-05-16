<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Create a class</h4>
		<br>
		<div id="complete-date">Date: <span></span></div>
	</div>
	
	<div class="modal-body">
		{{ Form::open(array('id' => 'newsession', 'url' => 'sessions', 'method' => 'post', 'class' => '')) }}
			<div class="col4">
				
				{{ Form::hidden( 's-evercisegroupId' , '', array('id' => 's-evercisegroupId')) }}
				{{ Form::hidden( 's-evercisegroupDuration' , '', array('id' => 's-evercisegroupDuration')) }}
				{{ Form::hidden( 's-year' , '', array('id' => 's-year')) }}
				{{ Form::hidden( 's-month' , '', array('id' => 's-month')) }}
				{{ Form::hidden( 's-date' , '', array('id' => 's-date')) }}
				@include('widgets.time', array('fieldname'=>'s-time', 'label'=>'Time'))
				@include('layouts.slider', array('fieldname'=>'price', 'label'=>'Price', 'placeholder'=>'Price', 'maxlength'=>3, 'fieldtext'=>null))
			</div>
			<div class="col3">
				<div class="grey-box">
					<p id="session-class-name">Class name: <span></span></p>
					<p id="session-class-price">Class price: &pound;<span></span></p>
					<p id="session-start-time">Start time: <span></span></p>
					<p id="session-end-time">End time: <span></span></p>
				</div>
				{{ Form::submit('Create session' , array('class'=>'btn-yellow ')) }}
			</div>
				
			
	    {{ Form::close() }}
    </div>

	
</div>