
	@include('form.textfield', array('fieldname'=>'venue_name', 'placeholder'=>'Max 45 characters', 'maxlength'=>45, 'label'=>'Venue Name', 'fieldtext'=>'the name of the venue', 'form' => 'venue_create' ))

	@include('widgets.mapForm', array( 'label'=>'Class Location','fieldname1'=>'street', 'placeholder1'=>'Street name and number', 'maxlength1'=>50, 'fieldname2'=>'city', 'placeholder2'=>'City', 'maxlength2'=>50, 'fieldname3'=>'postcode', 'placeholder3'=>'Post Code', 'maxlength3'=>10, 'fieldtext'=>'Enter the location of your class and make sure the marker appears in the correct place on the map above. (You can drag the marker to the correct place if it doesn&apos;t match up)', 'form' => 'venue_create'))

	{{-- var_dump($facilities) --}}
	<div class='formitem clearfix'>
		<div class='formlabel clearfix'>
			<label>Facilities</label>
		</div>
		<div class='formfield clearfix'>
			<ul class='facilities'>
				<h5>Amenities</h5>
				@foreach ($facilities as $f_key => $facility) 
					@if($facility->category == 'Amenity')
						<li>
							<div>
							{{ Form::checkbox( 'facilities_array[]',  $facility->id , false , array('id' => $facility->id, 'form' => 'venue_create', 'class' => 'facility_checkbox')) }}
							{{Form::label('facilities_array[]', $facility->name, array('id'=>'fac_check'))}}
							</div>
							{{ HTML::image('img/facility/'.$facility->image, $facility->image) }}
						</li>

					@endif

				@endforeach
				<hr>
				<h5>Facilities</h5>
				@foreach ($facilities as $f_key => $facility) 
					@if($facility->category == 'facility')
						<li>
							<div>
							{{ Form::checkbox( 'facilities_array[]',  $facility->id , false , array('id' => $facility->id, 'form' => 'venue_create', 'class' => 'facility_checkbox')) }}
							{{Form::label('facilities_array[]', $facility->name, array('id'=>'fac_check'))}}
							</div>
							{{ HTML::image('img/facility/'.$facility->image, $facility->image) }}
						</li>

					@endif

				@endforeach
			</ul>
		</div>
	</div>

    <div class="center-btn-wrapper" >
	   {{ Form::submit('Create Venue' , array('class'=>'btn-yellow ', 'form' => 'venue_create')) }}
    </div>

