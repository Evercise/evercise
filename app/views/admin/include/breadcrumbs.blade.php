<!-- breadcrumbs -->
<nav id="breadcrumbs">
    <ul>
        <li><a href="{{ URL::route('admin.dashboard') }}">Home</a></li>{{ $breadcrumbs or "" }}
        @if(!empty($breadcrumbs))
            @foreach($breadcrumbs as $route => $name)
                <li><a href="{{ URL::route($route) }}">{{ $name }}</a></li>
            @endforeach
        @endif
    </ul>
</nav>
