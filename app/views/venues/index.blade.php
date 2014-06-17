
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( 'venue', 'Venue') }}
	</div>
	<div class="formfield">
		@if(isset($selected))
			{{ Form::select( 'venue' , $venues , $selected) }}
		@else
			{{ Form::select( 'venue' , $venues ) }}
		@endif
		<button class="btn btn-blue" type="button" id="new_venue_button">Create new Venue</button>
	</div>
</div>

	
	