
	@include('form.textfield', array('fieldname'=>'venue_name', 'placeholder'=>'Max 45 characters', 'maxlength'=>45, 'label'=>'Venue Name', 'tooltip'=>'Enter the venue name', 'form' => 'venue_create' ))

	@include('widgets.mapForm', array( 'label'=>'Class Location','fieldname1'=>'street', 'placeholder1'=>'Street name and number', 'maxlength1'=>50, 'fieldname2'=>'city', 'placeholder2'=>'City', 'maxlength2'=>50, 'fieldname3'=>'postcode', 'placeholder3'=>'Post Code', 'maxlength3'=>10, 'fieldtext'=>'Make sure the marker appears in the correct place on the map below. (You can drag the marker to the correct place if it doesn&apos;t match up)', 'form' => 'venue_create'))

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
							{{ Form::checkbox( 'facilities_array[]',  $facility->id , false , array('id' => 'facilities_array_'.$facility->id, 'form' => 'venue_create', 'class' => 'facility_checkbox')) }}
							{{Form::label('facilities_array_'.$facility->id, $facility->name, array('id'=>'fac_check'))}}
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
							{{ Form::checkbox( 'facilities_array[]',  $facility->id , false , array('id' => 'facilities_array_'.$f_key, 'form' => 'venue_create', 'class' => 'facility_checkbox')) }}
							{{Form::label('facilities_array_'.$f_key, $facility->name, array('id'=>'fac_check'))}}
							</div>
							{{ HTML::image('img/facility/'.$facility->image, $facility->image) }}
						</li>

					@endif

				@endforeach
			</ul>
		</div>
	</div>

    <div class="center-btn-wrapper mb30" >
	   {{ Form::submit('Create Venue' , array('class'=>'btn-yellow ', 'form' => 'venue_create')) }}
    </div>

