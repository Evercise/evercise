<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::select( $fieldname , array(1=>'Male', 2=>'Female')) }}
	</div>
</div>