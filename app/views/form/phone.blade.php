<div class="formitem clearfix">
	@if(isset($label))
		<div class="formlabel">
			{{ Form::label( $fieldname, $label) }}
		</div>
	@endif
	<div class="formfield">
		@if( isset($form))
			{{ Form::text( 'areacode' , isset($default_area) ? $default_area : '', array('list' => 'area_codes' ,  'pattern' => isset($pattern) ? $pattern : null,  'placeholder' => 'Add area code', 'maxlength' => $maxlength, 'form' => $form , 'class' => 'half_input')) }}
			{{ Form::text( $fieldname , isset($default) ? $default : '', array(  'pattern' => isset($pattern) ? $pattern : null,  'placeholder' => $placeholder, 'maxlength' => $maxlength, 'form' => $form , 'class' => 'half_input')) }}
			<p>{{ $fieldtext }}</p>
		@else
			{{ Form::text( 'areacode' , isset($default_area) ? $default_area : '', array('list' => 'area_codes' ,'pattern' => isset($pattern) ? $pattern : null, 'placeholder' => 'Add area code', 'maxlength' => $maxlength, 'id' => 'areacode' , 'class' => 'half_input')) }}
			{{ Form::text( $fieldname , isset($default) ? $default : '', array( 'pattern' => isset($pattern) ? $pattern : null, 'placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname , 'class' => 'half_input')) }}
			<p>{{ $fieldtext }}</p>
		@endif
		<datalist id="area_codes">
			@foreach ($areacodes as $key => $areacode)
				<option value="{{$areacode->area_code}}">{{$areacode->area_code}}</option>
			@endforeach
		</datalist>
	</div>
</div>