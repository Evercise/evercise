
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::password( $fieldname ,  array('placeholder' => $placeholder, 'maxlength' => 32))}}
		@if ($confirmation)
			{{ Form::password( $fieldname.'_confirmation' ,  array('placeholder' => $confirmation, 'maxlength' => 32, 'id' => $fieldname.'_confirmation'))}}
		@endif
		<p>{{ $fieldtext }}</p>
		@if(isset($forgot))
			<br><br><br><p>{{ link_to('auth/forgot', $forgot) }}</p>
		@endif
	</div>
</div>