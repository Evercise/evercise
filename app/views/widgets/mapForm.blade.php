

<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( $fieldname1, $label) }}
	</div>
	<div class="formfield">

	<?php 
		if (isset($location))
		{
			$address = $location['address'];
			$city = $location['city'];
			$postCode = $location['postCode'];
			$lat = $location['lat'];
			$lng = $location['lng'];
		}
	?>

	@if(isset($form))
		{{ isset($fieldname1) ? Form::text( $fieldname1 , $address, array('id' => $fieldname1, 'class' => 'location-input mb10', 'placeholder' => $placeholder1, 'maxlength' => $maxlength1, 'form' => $form))  : null }}
		{{ isset($fieldname2) ? Form::text( $fieldname2 , $city, array('id' => $fieldname2, 'class' => 'location-input', 'placeholder' => $placeholder2, 'maxlength' => $maxlength2, 'form' => $form))  : null }}
		{{ isset($fieldname3) ? Form::text( $fieldname3 , $postCode, array('id' => $fieldname3, 'class' => 'location-input', 'placeholder' => $placeholder3, 'maxlength' => $maxlength3, 'form' => $form))  : null }}

	@else
		{{ isset($fieldname1) ? Form::text( $fieldname1 , $address, array('id' => $fieldname1, 'class' => 'location-input mb10', 'placeholder' => $placeholder1, 'maxlength' => $maxlength1))  : null }}
		{{ isset($fieldname2) ? Form::text( $fieldname2 , $city, array('id' => $fieldname2, 'class' => 'location-input', 'placeholder' => $placeholder2, 'maxlength' => $maxlength2))  : null }}
		{{ isset($fieldname3) ? Form::text( $fieldname3 , $postCode, array('id' => $fieldname3, 'class' => 'location-input', 'placeholder' => $placeholder3, 'maxlength' => $maxlength3))  : null }}

	@endif	


	<button type="button" class="btn btn-blue mb10 mt10" id="findLocation">find location</button>

		@if (isset($location))
			@include('widgets.map', array('form' => $form, 'lat'=>$location['lat'], 'lng'=>$location['lng']))
		@else
			@include('widgets.map', array('form' => $form))
		@endif
		<br>
		<p>{{ $fieldtext }}</p>
	</div>
</div>