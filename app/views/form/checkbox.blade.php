<div class="formitem clearfix">
	<div class="formlabel">
		{{ $testparam }}
	</div>
	<div class="formcheckbox">
		{{ Form::checkbox( $fieldname,  'checked') }}
		{{ Form::label( $fieldname, $label) }}
	</div>
</div>