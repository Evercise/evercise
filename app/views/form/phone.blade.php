<div class="formitem clearfix">
	@if(isset($label))
		<div class="formlabel">
			{{ Form::label( $fieldname, $label) }}
		</div>
	@endif

	<div class="formfield">
		<div class="input-prepend">
			@if( isset($form))
				{{-- Form::text( 'areacode' , isset($default_area) ? $default_area : '', array('list' => 'area_codes' ,  'pattern' => isset($pattern) ? $pattern : null,  'placeholder' => 'Add area code', 'maxlength' => $maxlength, 'id' => 'areacode', 'form' => $form , 'class' => 'half_input')) --}}
				{{ Form::text( $fieldname , isset($default) ? $default : '', array( 'data-tooltip' => isset($tooltip) ? $tooltip : null , 'pattern' => isset($pattern) ? $pattern : null,  'placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname , 'form' => $form , 'class' => isset($tooltip) ? 'half_input tooltip' : 'half_input')) }}
			@else
				{{ Form::select( 'areacode',  $country_codes, isset($default_area)?$default_area:'', ['id'=>'areacode']) }}
				<br>
				<br>
				{{ Form::text( $fieldname , isset($default) ? $default : '', array( 'data-tooltip' => isset($tooltip) ? $tooltip : null , 'pattern' => isset($pattern) ? $pattern : null, 'placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname , 'class' => isset($tooltip) ? 'half_input tooltip' : 'half_input')) }}<span class="add-on" id="country_code">-</span>
				
			@endif
			{{-- <datalist id="area_codes">
				@foreach ($areacodes as $key => $areacode)
					<option value="{{$areacode->area_code}}">{{$areacode->area_code}}</option>
				@endforeach
			</datalist>
			--}}
		</div>
	@if(isset($fieldtext))
		<p>{{ $fieldtext  }}</p>
	@endif
	</div>
</div>