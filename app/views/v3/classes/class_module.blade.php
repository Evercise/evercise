<!--
<div class="class-module center-block">
    <div class="class-image-wrapper">
         {{ HTML::decode( HTML::linkRoute('evercisegroups.show', image($class->user->directory. '/thumb_'. $class->image,  $class->name . ' cover image') , $class->id)  )}}
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

<ul class="list-group class-block-module ">
    <div class="class-image-wrapper">
         {{ HTML::decode( HTML::linkRoute('evercisegroups.show', image($class->user->directory. '/module_'. $class->image,  $class->name . ' cover image', ['class' => 'img-responsive img-full-width']) , $class->id)  )}}
    </div>
    <li class="list-group-item">

        <div class="class-title-wrapper text-center">
            <a href="#"><h3>{{ $class->name }}</h3></a>
            <div class="class-rating-wrapper">
                @if (isset($class->ratings))
                    @include('v3.classes.ratings.stars', array('rating' => $class->ratings))
                @endif
            </div>
        </div>
    </li>
    <li class="list-group-item bg-light-grey">
        <div class="class-info-wrapper  row">
            <div class="pull-left">
                <span class="icon icon-clock"></span>{{ date('M jS, g:ia' ,strtotime($class->futuresessions[0]->date_time ) )}}
            </div>

            <div class="pull-left ml20"><span class="icon icon-watch"></span> {{$class->futuresessions[0]->duration}} mins</div>
            <div class="pull-right"><span class="icon icon-ticket"></span> x {{$class->futuresessions[0]->remaining}}</div>

        </div>
    </li>
    <li class="list-group-item bg-light-grey">
        <div class="class-info-wrapper  row">
            <div class="col-xs-6" ><strong class="text-primary">&pound;{{ $class->futuresessions[0]->price }}</strong></div>
            <div class="col-xs-6"> {{ HTML::linkRoute('evercisegroups.show', 'Join Class', $class->id, ['class'=>'btn btn-default pull-right']) }}</div>
        </div>
    </li>
</ul>
