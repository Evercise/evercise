
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		
		@if ($confirmation)
			{{ Form::password( $fieldname ,  array('data-tooltip' => isset($tooltip) ? $tooltip : null , 'placeholder' => $placeholder, 'maxlength' => 32, 'id' => isset($confirmation) ? $fieldname.'_confirmation' : null, 'class' => isset($tooltip) ? 'tooltip' : null))}}
			{{ Form::password( $fieldname.'_confirmation' ,  array('placeholder' => $confirmation, 'maxlength' => 32, 'id' => $fieldname, 'class' => isset($tooltip) ? 'tooltip mt10' : 'mt10'))}}
		@else
			{{ Form::password( $fieldname ,  array('data-tooltip' => isset($tooltip) ? $tooltip : null , 'placeholder' => $placeholder, 'maxlength' => 32, 'class' => isset($tooltip) ? 'tooltip' : null))}}
		@endif
		@if(isset($fieldtext))
			<p>{{ $fieldtext  }}</p>
		@endif
		@if(isset($forgot))
			<br><br><br><p>{{ link_to('auth/forgot', $forgot) }}</p>
		@endif
	</div>
</div>