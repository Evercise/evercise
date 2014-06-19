<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Create a Session</h4>
		<br>
		<div id="complete-date">Date: {{ $date.'-'.$month.'-'.$year }}<span></span></div>
	</div>
	
	<div class="modal-body">
		{{ Form::open(array('id' => 'newsession', 'url' => 'sessions', 'method' => 'post', 'class' => '')) }}
			<div class="col4">
				
				{{ Form::hidden( 's-evercisegroupId' , $id, array('id' => 's-evercisegroupId')) }}
				{{ Form::hidden( 's-year' , $year, array('id' => 's-year')) }}
				{{ Form::hidden( 's-month' , $month, array('id' => 's-month')) }}
				{{ Form::hidden( 's-date' , $date, array('id' => 's-date')) }}
				@include('widgets.time', array('fieldname'=>'s-time', 'label'=>'Time', 'hourDefault'=>$hour, 'minuteDefault'=>$minute))

				@include('form.slider', array('fieldname'=>'s-price', 'label'=>'Price', 'placeholder'=>'Price', 'maxlength'=>6, 'fieldtext'=>null, 'default'=>$price))
				@include('form.slider', array('fieldname'=>'s-duration', 'label'=>'Duration', 'placeholder'=>'Duration', 'maxlength'=>6, 'fieldtext'=>null, 'default'=>$duration))
			</div>
			<div class="col3">
				<div class="grey-box">
					<p id="session-class-name">Class name: <span>{{ $name }}</span></p>
					<p id="session-class-price">Class price: &pound;<span>{{ $price }}</span></p>
					<p id="session-class-duration">Class duration: <span>{{ $duration }}</span></p>
					<p id="session-start-time">Start time: <span></span></p>
					<p id="session-end-time">End time: <span></span></p>
				</div>
				{{ Form::submit('Create session' , array('class'=>'btn-yellow ')) }}
			</div>
				
			
	    {{ Form::close() }}
    </div>

</div>