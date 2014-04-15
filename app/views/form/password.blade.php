
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::password( $fieldname , '', array('placeholder' => $placeholder, 'maxlength' => 20))}}
		@if ($confirmation)
			{{ Form::password( $fieldname.'_confirmation' , '', array('placeholder' => $placeholder, 'maxlength' => 20))}}
		@endif
		<p>{{ $fieldtext }}</p>
	</div>
</div>