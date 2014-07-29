
<div class="category-box">
	@foreach($categories as $key => $category)
		{{ HTML::image('img/category/'.$category->image, $category->name, array('class'=> 'tooltip category-image', 'data-tooltip' => $category->name))}}
	@endforeach
	
</div>


