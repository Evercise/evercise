

<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname1, $label) }}
	</div>
	<div class="formfield">

	@if(isset($location))
		{{ isset($fieldname1) ? Form::text( $fieldname1 , $location['address'], array('id' => $fieldname1, 'class' => 'location-input', 'placeholder' => $placeholder1, 'maxlength' => $maxlength1))  : null }}
		{{ isset($fieldname2) ? Form::text( $fieldname2 , $location['city'], array('id' => $fieldname2, 'class' => 'location-input', 'placeholder' => $placeholder2, 'maxlength' => $maxlength2))  : null }}
		{{ isset($fieldname3) ? Form::text( $fieldname3 , $location['postCode'], array('id' => $fieldname3, 'class' => 'location-input', 'placeholder' => $placeholder3, 'maxlength' => $maxlength3))  : null }}

	@else

		{{ isset($fieldname1) ? Form::text( $fieldname1 , $address, array('id' => $fieldname1, 'class' => 'location-input', 'placeholder' => $placeholder1, 'maxlength' => $maxlength1))  : null }}
		{{ isset($fieldname2) ? Form::text( $fieldname2 , $city, array('id' => $fieldname2, 'class' => 'location-input', 'placeholder' => $placeholder2, 'maxlength' => $maxlength2))  : null }}
		{{ isset($fieldname3) ? Form::text( $fieldname3 , $postCode, array('id' => $fieldname3, 'class' => 'location-input', 'placeholder' => $placeholder3, 'maxlength' => $maxlength3))  : null }}

	@endif	


	<button type="button" class="btn btn-blue" id="findLocation">find location</button>
	
		@include('widgets.map')
		<br>
		<p>{{ $fieldtext }}</p>
	</div>
</div>