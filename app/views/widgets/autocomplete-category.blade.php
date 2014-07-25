

<div class="formitem clearfix">
	@if(isset($label))
		<div class="formlabel">
			{{ Form::label( $fieldname, $label) }}
		</div>
	@endif
	<div class="formfield">

		<div id="categoryField">
		  <input class="category" placeholder="Start typing" type="text" name="{{ $fieldname }}" id="{{ $fieldname }}" value=""/>
		</div>
	</div>
</div>
