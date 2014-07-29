<div class="formitem clearfix">
	<div class="formcheckbox">

		{{ Form::checkbox( $fieldname,  '1' , isset($default) ? $default : false , array('data-tooltip' => isset($tooltip) ? $tooltip : null ,'id' => $id , 'class' => isset($tooltip) ? 'tooltip' : null)) }}
		{{ Form::label( $fieldname, $label) }}
	</div>
</div>