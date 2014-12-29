<!--
<div class="class-module center-block">
    <div class="class-image-wrapper">
         {{ HTML::decode( HTML::linkRoute('class.show', image($class->user->directory. '/thumb_'. $class->image,  $class->name . ' cover image') , $class->slug)  )}}
    </div>
    <div class="class-title-wrapper text-center">
        <a href="#"><h3>{{ $class->name }}</h3></a>
        <div class="class-rating-wrapper">
            @if (isset($class->ratings))
                @include('v3.classes.ratings.stars', array('rating' => $class->ratings))
            @endif
        </div>
    </div>
    <div class="class-info-wrapper panel-body bg-light-grey row">
        <div class="col-sm-6">
            <span class="icon icon-clock"></span>{{ date('M dS, h:ia' ,strtotime($class->futuresessions[0]->date_time ) )}}
        </div>

        <div class="pull-left mr15"><span class="icon icon-watch"></span> {{$class->futuresessions[0]->duration}} mins</div>
        <div class="pull-left"><span class="icon icon-ticket"></span> x 5</div>

    </div>
    <div class="class-info-wrapper panel-body bg-light-grey row">
        <div class="col-xs-6" ><strong class="text-primary">&pound;{{ $class->futuresessions[0]->price }}</strong></div>
        <div class="col-xs-6"> {{ HTML::linkRoute('evercisegroups.show', 'Join Class', $class->id, ['class'=>'btn btn-default pull-right']) }}</div>
    </div>
</div>
-->

<ul class="list-group class-module" onclick="ga('send', 'event', 'View Class', 'click', 'Home Page View Class ',20)">
    <div class="class-image-wrapper">
         {{ HTML::decode( HTML::linkRoute('class.show', image($class->user->directory. '/module_'. $class->image,  $class->name . ' cover image', ['class' => 'img-responsive img-full-width']) , $class->slug)  )}}
    </div>
    <li class="list-group-item">

        <div class="class-title-wrapper text-center">
            <a href="{{ URL::route('class.show', [$class->slug]) }}"><h3>{{ $class->name }}</h3></a>
            <div class="class-rating-wrapper">
                @if (isset($class->ratings))
                    @include('v3.classes.ratings.stars', array('rating' => $class->ratings))
                @endif
            </div>
        </div>
    </li>
    <li class="list-group-item bg-light-grey">
        <div class="class-info-wrapper  row">
            <div class="col-xs-6">
                <span class="icon icon-clock"></span><small> <time datetime="{{ date('Y-m-d H:i' ,strtotime($class->futuresessions[0]->date_time ) )}}">{{ date('M jS, g:ia' ,strtotime($class->futuresessions[0]->date_time ) )}}</time></small>
            </div>
            <div class="col-xs-6">
                <div class="row no-gutter">
                    <div class="col-xs-7"><span class="icon icon-watch"></span> <small>{{$class->futuresessions[0]->duration}} mins</small></div>
                    <div class="col-xs-5"><span class="icon icon-ticket"></span><small> x {{$class->futuresessions[0]->remaining}}</small> </div>
                </div>
            </div>


        </div>
    </li>
    <li class="list-group-item bg-light-grey">
        <div class="class-info-wrapper  row">
            <div class="col-xs-6 mt5" ><strong class="text-large text-primary">&pound;{{ number_format($class->futuresessions[0]->price, 2, '.', '') }}</strong></div>
            <div class="col-xs-6"> {{ HTML::linkRoute('class.show', 'Join Class', $class->slug, ['class'=>'btn btn-default pull-right']) }}</div>
        </div>
    </li>
</ul>
