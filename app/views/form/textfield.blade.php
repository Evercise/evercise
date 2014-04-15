
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::text( $fieldname , '', array('placeholder' => $placeholder, 'maxlength' => 20)) }}
		<p>{{ $fieldtext }}</p>
	</div>
</div>