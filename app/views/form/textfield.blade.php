
<div class="formitem clearfix">
	@if(isset($label))
		<div class="formlabel">
			{{ Form::label( $fieldname, $label) }}
		</div>
	@endif
	<div class="formfield">
		@if( isset($form))
			{{ Form::text( $fieldname , isset($default) ? $default : '', array('placeholder' => $placeholder, 'maxlength' => $maxlength, 'form' => $form )) }}
			<p>{{ $fieldtext }}</p>
		@else
			{{ Form::text( $fieldname , isset($default) ? $default : '', array('placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname)) }}
			<p>{{ $fieldtext }}</p>
		@endif
	</div>
</div>