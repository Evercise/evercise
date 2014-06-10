{{ Form::open(array('id' => 'venue_create', 'url' => 'venues', 'method' => 'post', 'class' => 'create-form')) }}

	@include('form.select', array('fieldname'=>'venue', 'label'=>'Venue', 'values'=>$venues ))

	@include('form.textfield', array('fieldname'=>'venue_name', 'placeholder'=>'Max 50 characters', 'maxlength'=>50, 'label'=>'Venue Name', 'fieldtext'=>'the name of the venue' ))

	@include('widgets.mapForm', array( 'label'=>'Class Location','fieldname1'=>'street', 'placeholder1'=>'Street name and number', 'maxlength1'=>50, 'fieldname2'=>'city', 'placeholder2'=>'City', 'maxlength2'=>50, 'fieldname3'=>'postcode', 'placeholder3'=>'Post Code', 'maxlength3'=>10, 'fieldtext'=>'Enter the location of your class and make sure the marker appears in the correct place on the map above. (You can drag the marker to the correct place if it doesn&apos;t match up)'))

	{{-- var_dump($facilities) --}}
	@foreach ($facilities as $f_key => $facility) 
		{{ Form::checkbox( 'facilities_array[]',  $facility->id , false , array('id' => $facility->id)) }}
		{{ Form::label( $facility->name, $facility->name) }}
	@endforeach

    <div class="center-btn-wrapper" >
	   {{ Form::submit('Create Venue' , array('class'=>'btn-yellow ')) }}
    </div>

    <div class="success_msg">Success!</div>

{{ Form::close() }}