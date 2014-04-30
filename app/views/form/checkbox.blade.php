<div class="formitem clearfix">
	<div class="formcheckbox">
		{{ Form::checkbox( $fieldname,  '1' , true , array('id' => $id)) }}
		{{ Form::label( $fieldname, $label) }}
	</div>
</div>