

<div class="formitem clearfix">
	@if(isset($label))
		<div class="formlabel">
			{{ Form::label( $fieldname, $label) }}
		</div>
	@endif
	<div class="formfield">

		<div id="categoryField">
		  <input class="category {{isset($tooltip) ? 'tooltip' : null }}" placeholder="{{isset($placeholder)? $placeholder : $fieldname}}" type="text" name="{{ $fieldname }}" id="{{ $fieldname }}" value="{{ isset($selectedCategory) ? $selectedCategory : '' }}" data-tooltip = " {{isset($tooltip) ? $tooltip : null}}" />
		</div>
	</div>
</div>
