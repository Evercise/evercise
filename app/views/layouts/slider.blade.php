	<div class="formlabel">
		{{ Form::label( $fieldname, $label) }}
	</div>
	<div class="formfield">
		<div class="{{$fieldname}}_pre slider_pre"></div>

		@if(isset($default))
			{{ Form::text( $fieldname , $default, array( 'data-tooltip' => isset($tooltip) ? $tooltip : null , 'class' => isset($tooltip) ? ' tooltip slider-input' : 'slider-input', 'placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
		@else
			{{ Form::text( $fieldname , '', array( 'data-tooltip' => isset($tooltip) ? $tooltip : null , 'class' => isset($tooltip) ? ' tooltip slider-input' : 'slider-input', 'placeholder' => $placeholder, 'maxlength' => $maxlength)) }}
		@endif

		<div id="{{$fieldname}}-slider" class="slider mt10"></div>
		<br>
		@if(isset($fieldtext))
			<p>{{ $fieldtext  }}</p>
		@endif

	</div>
