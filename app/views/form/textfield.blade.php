
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		@if( isset($default))
			{{ Form::text( $fieldname , $default, array('placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
			<p>{{ $fieldtext }}</p>
		@else
			{{ Form::text( $fieldname , '', array('placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
			<p>{{ $fieldtext }}</p>
		@endif
	</div>
</div>