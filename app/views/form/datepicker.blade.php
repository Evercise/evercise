
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::text( $fieldname , isset($default) ? $default : null, array('data-tooltip' => isset($tooltip) ? $tooltip : null , 'pattern' => isset($pattern) ? $pattern : null, 'id'=> isset($id) ? $fieldname.'_'.$id : $fieldname, 'class' =>  isset($tooltip) ? 'datepicker tooltip' : 'datepicker','placeholder' => $placeholder, 'maxlength' => $maxlength, 'data-datepicker' => 'datepicker')) }}
		@if(isset($fieldtext))
			<p>{{ $fieldtext  }}</p>
		@endif
	</div>
</div>
