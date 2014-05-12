<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	Session create
	{{ Form::open(array('id' => 'newsession', 'url' => 'sessions', 'method' => 'post', 'class' => '')) }}
		{{ Form::hidden( 's-evercisegroupId' , '', array('id' => 's-evercisegroupId')) }}
		{{ Form::hidden( 's-year' , '', array('id' => 's-year')) }}
		{{ Form::hidden( 's-month' , '', array('id' => 's-month')) }}
		{{ Form::hidden( 's-date' , '', array('id' => 's-date')) }}
		@include('widgets.time', array('fieldname'=>'s-time', 'label'=>'Time'))
		@include('form.generalslider', array('fieldname'=>'s-time', 'label'=>'Time', 'placeholder'=>'Time', 'maxlength'=>'Time', 'fieldtext'=>'why is there no slider here?'))
		<div id="complete-date"></div>
		{{ Form::submit('Create session' , array('class'=>'btn-yellow ')) }}

    {{ Form::close() }}
</div>