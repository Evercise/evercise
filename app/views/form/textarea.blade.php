<div class="formitem clearfix">
	@if(isset($label))
		<div class="formlabel">
			{{ Form::label( $fieldname, $label) }}
		</div>
	@endif
	<div class="formfield">
		@if( isset($form))
			{{ Form::textarea( $fieldname , isset($default) ? $default : '', array(  'pattern' => isset($pattern) ? $pattern : null,  'placeholder' => $placeholder, 'maxlength' => $maxlength, 'form' => $form )) }}
			<p>{{ $fieldtext }}</p>
		@else
			{{ Form::textarea( $fieldname , isset($default) ? $default : '', array( 'pattern' => isset($pattern) ? $pattern : null, 'placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname)) }}
			<p>{{ $fieldtext }}</p>
		@endif
	</div>
</div>