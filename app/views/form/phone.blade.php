
<div class="formitem clearfix">
	@if(isset($label))
		<div class="formlabel">
			{{ Form::label( $fieldname, $label) }}
		</div>
	@endif
	<div class="formfield">
		@if( isset($form))
			{{ Form::text( $fieldname , isset($default) ? $default : '', array('list' => 'area_codes' ,  'pattern' => isset($pattern) ? $pattern : null,  'placeholder' => $placeholder, 'maxlength' => $maxlength, 'form' => $form )) }}
			<datalist id="area_codes">
				<option value="1">1</option>
				<option value="2">2</option>
			</datalist>
			{{ Form::text( $fieldname , isset($default) ? $default : '', array(  'pattern' => isset($pattern) ? $pattern : null,  'placeholder' => $placeholder, 'maxlength' => $maxlength, 'form' => $form )) }}
			<p>{{ $fieldtext }}</p>
		@else
			{{ Form::text( $fieldname , isset($default) ? $default : '', array('list' => 'area_codes' ,'pattern' => isset($pattern) ? $pattern : null, 'placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname)) }}
			<datalist id="area_codes">
				<option value="111">111</option>
				<option value="2222">2222</option>
			</datalist>
			{{ Form::text( $fieldname , isset($default) ? $default : '', array( 'pattern' => isset($pattern) ? $pattern : null, 'placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname)) }}
			<p>{{ $fieldtext }}</p>
		@endif
	</div>
</div>