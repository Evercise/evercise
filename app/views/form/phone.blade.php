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
				{{ Form::text( $fieldname , isset($default) ? $default : '', array(  'pattern' => isset($pattern) ? $pattern : null,  'placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname , 'form' => $form , 'class' => 'half_input')) }}
			@else
				{{ Form::select( 'areacode',  $country_codes, isset($area_code)?$area_code:'', ['id'=>'areacode']) }}
				
				{{ Form::text( $fieldname , isset($default) ? $default : '', array( 'pattern' => isset($pattern) ? $pattern : null, 'placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname , 'class' => 'half_input')) }}<span class="add-on" id="country_code">-</span>
				
			@endif
			{{-- <datalist id="area_codes">
				@foreach ($areacodes as $key => $areacode)
					<option value="{{$areacode->area_code}}">{{$areacode->area_code}}</option>
				@endforeach
			</datalist>
			--}}
		</div>
	<p>{{ $fieldtext }}</p>
	</div>
</div>