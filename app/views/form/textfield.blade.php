
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::text( $fieldname , '', array('placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
		<p>{{ $fieldtext }}</p>
	</div>
</div>