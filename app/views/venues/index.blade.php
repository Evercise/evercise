
<div class="formitem clearfix">
	<div class="formlabel">
		{{ Form::label( 'venue', 'Venue') }}
	</div>
	<div class="formfield">
		<button class="btn btn-yellow" type="button" id="new_venue_button">Create new Venue</button>
		
		<div id="venue_select_wrap" class="mt10">
			@if(isset($selected))
				{{ Form::select( 'venue' , $venues , $selected) }}
			@else
				{{ Form::select( 'venue' , $venues ) }}
			@endif
			<button class="btn btn-blue {{count($venues) ? '' : 'disabled'}}" type="button" id="edit_venue_button">Edit Venue</button>
		</div>
		
	</div>
</div>

	
	