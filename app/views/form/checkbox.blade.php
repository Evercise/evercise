<div class="formitem clearfix">
	<div class="formcheckbox">
		{{ Form::checkbox( $fieldname,  'checked' , 'checked' , array('id' => $id)) }}
		{{ Form::label( $fieldname, $label) }}
	</div>
</div>