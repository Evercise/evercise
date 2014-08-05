

<div class="formitem clearfix">
	@if(isset($label))
		<div class="formlabel">
			{{ Form::label( $fieldname, $label) }}
		</div>
	@endif
	<div class="formfield">

		<div id="categoryField">
		  <input class="category" placeholder="{{Loc::text('discover', 'search_box')}}" type="text" name="{{ $fieldname }}" id="{{ $fieldname }}" value="{{ isset($selectedCategory) ? $selectedCategory : '' }}"/>
		</div>
	</div>
</div>
