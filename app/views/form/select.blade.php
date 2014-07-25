<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
	@if(isset($selected))
		{{ Form::select( $fieldname , $values , $selected, ['data-tooltip' => isset($tooltip) ? $tooltip : null , 'class' => isset($tooltip) ? 'tooltip' : null]) }}
	@else
		{{ Form::select( $fieldname , $values , null , ['data-tooltip' => isset($tooltip) ? $tooltip : null , 'class' => isset($tooltip) ? 'tooltip' : null] ) }}
	@endif
	</div>
</div>