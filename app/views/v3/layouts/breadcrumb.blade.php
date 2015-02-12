@if(isset($breadcrumbs))
    <span class="text-large"><a class="text-white" href="{{ URL::to('/') }}" title="Evercise Something">Home</a>
        @foreach($breadcrumbs as $title => $url)
            <span class="text-primary">></span>
            @if(!empty($url))
                <a class="text-white"  href="{{ $url }}" title="{{ $title  }}">{{$title}}</a>
            @else
                {{$title}}
            @endif
        @endforeach
    </span>

@endif


