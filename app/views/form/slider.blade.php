<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::text( $fieldname , '', array( 'class' => 'slider-input', 'placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
		<div id="{{$fieldname}}-slider" class="slider"></div>
		<br>
		<p>{{ $fieldtext }}</p>

	</div>
</div>