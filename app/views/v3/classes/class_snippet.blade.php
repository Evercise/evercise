<div class="class-snippet" data-target="{{$class->id}}">
    <div class="class-image-wrapper col-sm-4">
        {{ HTML::image('profiles/'.$class->user->directory .'/'. $class->image, 'class image') }}
    </div>
    <div class="class-title-wrapper panel-body col-sm-8">
        <div class="ml10">
            <a href="#"><h3>{{  str_limit($class->name, 22) }}</h3></a>
        </div>
        <div class="class-rating-wrapper col-xs-9">
            @if (isset($class->ratings))
                @include('v3.classes.ratings.stars', array('rating' => $class->ratings))
            @endif
        </div>
        <div class="col-xs-3">

            <strong class="text-primary">&pound;{{$class->default_price}}</strong>
        </div>
    </div>
</div>