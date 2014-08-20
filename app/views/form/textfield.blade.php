
<div class="formitem clearfix">
	@if(isset($label))
		<div class="formlabel">
			{{ Form::label( $fieldname, $label) }}
		</div>
	@endif
	<div class="formfield">
		@if( isset($form))
			@if(isset($insert))
				<div class="input-insert">{{$insert}}</div>
				<div class="inputted">
			@endif
			{{ Form::text( $fieldname , isset($default) ? $default : '', array('data-tooltip' => isset($tooltip) ? $tooltip : null ,  'pattern' => isset($pattern) ? $pattern : null,  'placeholder' => $placeholder, 'maxlength' => $maxlength, 'form' => $form ,  'class' => isset($tooltip) ? 'tooltip' : null   )) }}
			@if(isset($insert))
				</div>
			@endif

			@if(isset($fieldtext))
				<p>{{ $fieldtext  }}</p>
			@endif
		@else
			@if(isset($insert))
				<div class="input-insert">{{$insert}}</div>
				<div class="inputted">
			@endif
			{{ Form::text( $fieldname , isset($default) ? $default : '', array( 'data-tooltip' => isset($tooltip) ? $tooltip : null , 'pattern' => isset($pattern) ? $pattern : null, 'placeholder' => $placeholder, 'maxlength' => $maxlength, 'id' => $fieldname , 'class' => isset($tooltip) ? 'tooltip' : null)) }}
			@if(isset($insert))
				</div>
			@endif
			@if(isset($fieldtext))
				<p>{{ $fieldtext  }}</p>
			@endif
		@endif
	</div>
</div>