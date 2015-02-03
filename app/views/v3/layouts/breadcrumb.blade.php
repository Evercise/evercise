@if(isset($breadcrumbs))
	<ul>
		<li><a href="{{ URL::to('/') }}" title="Evercise Something">Home</a></li>

		@foreach($breadcrumbs as $title => $url)
			@if(!empty($url))
				<li><a href="{{ $url }}" title="{{ $title  }}">{{$title}}</a></li>
			@else
				<li>{{$title}}</li>
			@endif
		@endforeach
	</ul>
@endif