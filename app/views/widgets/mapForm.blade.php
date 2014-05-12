

<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname1, $label) }}
	</div>
	<div class="formfield">

	{{ isset($fieldname1) ? Form::text( $fieldname1 , $houseNumber, array('id' => $fieldname1, 'class' => 'location-input', 'placeholder' => $placeholder1, 'maxlength' => $maxlength1))  : null }}
	{{ isset($fieldname2) ? Form::text( $fieldname2 , $streetName, array('id' => $fieldname2, 'class' => 'location-input', 'placeholder' => $placeholder2, 'maxlength' => $maxlength2))  : null }}
	{{ isset($fieldname3) ? Form::text( $fieldname3 , $city, array('id' => $fieldname3, 'class' => 'location-input', 'placeholder' => $placeholder3, 'maxlength' => $maxlength3))  : null }}	
	{{ isset($fieldname4) ? Form::text( $fieldname4 , $postCode, array('id' => $fieldname4, 'class' => 'location-input', 'placeholder' => $placeholder4, 'maxlength' => $maxlength4))  : null }}

	 {{ Form::hidden( 'latbox' , null, array('id' => 'latbox')) }}

	  {{ Form::hidden( 'lngbox' , null, array('id' => 'lngbox')) }}

	<button type="button" class="btn btn-blue" id="findLocation">find location</button>
	
		@include('widgets.map')
		<br>
		<p>{{ $fieldtext }}</p>
	</div>
</div>