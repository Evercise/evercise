<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<h4>Create a class</h4>
	{{ Form::open(array('id' => 'newsession', 'url' => 'sessions', 'method' => 'post', 'class' => '')) }}

		<div class="col4">
			<div id="complete-date">Date: <span></span></div>
			{{ Form::hidden( 's-evercisegroupId' , '', array('id' => 's-evercisegroupId')) }}
			{{ Form::hidden( 's-year' , '', array('id' => 's-year')) }}
			{{ Form::hidden( 's-month' , '', array('id' => 's-month')) }}
			{{ Form::hidden( 's-date' , '', array('id' => 's-date')) }}
			@include('widgets.time', array('fieldname'=>'s-time', 'label'=>'Time'))
			@include('layouts.slider', array('fieldname'=>'price', 'label'=>'Price', 'placeholder'=>'Price', 'maxlength'=>3, 'fieldtext'=>'Price of this session'))
		</div>
		<div class="col2">
			{{ Form::submit('Create session' , array('class'=>'btn-yellow ')) }}
		</div>
    {{ Form::close() }}
</div>
<script>initSlider('{"name":"price","min":0,"max":99,"step":0.5,"value":1}');</script>