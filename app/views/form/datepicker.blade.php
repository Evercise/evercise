
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::text( $fieldname , isset($default) ? $default : null, array( 'pattern' => isset($pattern) ? $pattern : null, 'class' => 'datepicker','placeholder' => $placeholder, 'maxlength' => $maxlength, 'data-datepicker' => 'datepicker')) }}
		<p>{{ $fieldtext }}</p>
	</div>
</div>