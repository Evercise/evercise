
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::password( $fieldname ,  array('placeholder' => $placeholder, 'maxlength' => 20))}}
		@if ($confirmation)
			{{ Form::password( $fieldname.'_confirmation' ,  array('placeholder' => $confirmation, 'maxlength' => 20, 'id' => $fieldname.'_confirmation'))}}
		@endif
		<p>{{ $fieldtext }}</p>
	</div>
</div>