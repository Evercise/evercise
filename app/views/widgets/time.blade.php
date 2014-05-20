<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		{{ Form::select( $fieldname.'-hour' , $hours, $hourDefault, array('class' => 'time-box', 'id'=> $fieldname.'-hour')) }}
		{{ Form::select( $fieldname.'-minute' , $minutes, $minuteDefault, array('class' => 'time-box', 'id'=>$fieldname.'-minute')) }}
	</div>
</div>