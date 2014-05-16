	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		<div class="{{$fieldname}}_pre slider_pre"></div>

		@if(isset($default))
			{{ Form::text( $fieldname , $default, array( 'class' => 'slider-input', 'placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
		@else
			{{ Form::text( $fieldname , '', array( 'class' => 'slider-input', 'placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
		@endif

		<div id="{{$fieldname}}-slider" class="slider"></div>
		<br>
		<p>{{ $fieldtext }}</p>

	</div>
