<div class="formitem clearfix">
	@if(isset($label))
		<div class="formlabel">
			{{ Form::label( $fieldname, $label) }}
		</div>
	@endif
	<div class="formfield">
		@if( isset($form))
			{{ Form::textarea( $fieldname , isset($default) ? $default : '', array( 'data-tooltip' => isset($tooltip) ? $tooltip : null ,  'pattern' => isset($pattern) ? $pattern : null,  'placeholder' => $placeholder, 'maxlength' => $maxlength, 'form' => $form, 'class' => isset($tooltip) ? 'tooltip' : null )) }}
			@if(isset($fieldtext))
				<p>{{ $fieldtext  }}</p>
			@endif
		@else
			{{ Form::textarea( $fieldname , isset($default) ? $default : '', array( 'data-tooltip' => isset($tooltip) ? $tooltip : null , 'pattern' => isset($pattern) ? $pattern : null, 'placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname , 'class' => isset($tooltip) ? 'tooltip' : null)) }}
			@if(isset($fieldtext))
				<p>{{ $fieldtext  }}</p>
			@endif
		@endif
	</div>
</div>