<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::select( $fieldname.'-hour' , $hours) }}
		{{ Form::select( $fieldname.'-minute' , $minutes) }}
	</div>
</div>