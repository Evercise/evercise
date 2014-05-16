
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		@if( isset($value))
			{{ Form::text( $fieldname , $value, array('placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
			<p>{{ $fieldtext }}</p>
		@else
			{{ Form::text( $fieldname , '', array('placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
			<p>{{ $fieldtext }}</p>
		@endif
	</div>
</div>