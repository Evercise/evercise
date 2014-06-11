
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		@if( isset($form))
			{{ Form::text( $fieldname , isset($default) ? $default : '', array('placeholder' => $placeholder, 'maxlength' => $maxlength, 'form' => $form )) }}
			<p>{{ $fieldtext }}</p>
		@else
			{{ Form::text( $fieldname , isset($default) ? $default : '', array('placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
			<p>{{ $fieldtext }}</p>
		@endif
	</div>
</div>