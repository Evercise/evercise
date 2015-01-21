<ul class="list-group class-block ">
    <li class="list-group-item class-img-wrapper">
        {{ image($result->user->directory.'/preview_'.$result->image, $result->image, ['class' => 'img-responsive']) }}
    </li>
    <div class="class-body">
        {{ image($result->user->directory.'/search_'.$result->image, $result->image, ['class' => 'img-responsive']) }}
        <li class="list-group-item text-center class-title">
            <h4>{{ str_limit($result->name, 25, '...')  }}</h4>
            <p><span class="icon icon-pointer"></span>{{ $result->venue->town }}</p>
        </li>
        <li class="list-group-item class-footer">
            <aside class="text-center"><strong class="text-primary">£{{ round($result->default_price ,2)}}</strong></aside>
            <aside class="btn-wrapper">{{ Html::linkRoute('class.show', 'View Class', $result->slug, ['class' => 'btn btn-primary']) }}</aside>
        </li>
    </div>
</ul>