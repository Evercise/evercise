

<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname1, $label) }}
	</div>
	<div class="formfield">

	{{ isset($fieldname1) ? Form::text( $fieldname1 , '', array('class' => 'location-input', 'placeholder' => $placeholder1, 'maxlength' => $maxlength1))  : null }}
	{{ isset($fieldname2) ? Form::text( $fieldname2 , '', array('class' => 'location-input', 'placeholder' => $placeholder2, 'maxlength' => $maxlength2))  : null }}
	{{ isset($fieldname3) ? Form::text( $fieldname3 , '', array('class' => 'location-input', 'placeholder' => $placeholder3, 'maxlength' => $maxlength3))  : null }}	
	{{ isset($fieldname4) ? Form::text( $fieldname4 , '', array('class' => 'location-input', 'placeholder' => $placeholder4, 'maxlength' => $maxlength4))  : null }}

	
	
		@include('widgets.map')
		{{ $houseNumber }}
		<br>
		{{ $streetName }}
		<br>
		{{ $city }}

		<br>
		<p>{{ $fieldtext }}</p>
	</div>
</div>