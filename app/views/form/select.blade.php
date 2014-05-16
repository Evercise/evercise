<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
	@if(isset($selected))
		{{ Form::select( $fieldname , $values , $selected) }}
	@else
		{{ Form::select( $fieldname , $values ) }}
	@endif
	</div>
</div>