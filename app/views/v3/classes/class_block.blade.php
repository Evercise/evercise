<ul class="list-group class-block ">
    <li class="list-group-item class-img-wrapper">
        {{ Html::decode( Html::linkRoute('class.show', image($result->user->directory.'/preview_'.$result->image, $result->image, ['class' => 'img-responsive']) , $result->slug ) ) }}
    </li>
    <div class="class-body">
        {{ Html::decode( Html::linkRoute('class.show', image($result->user->directory.'/search_'.$result->image, $result->image, ['class' => 'img-responsive']) , $result->slug ) ) }}
        <li class="list-group-item text-center class-title">
            <h4>{{ Html::decode( Html::linkRoute('class.show',str_limit($result->name, 25, '...'), $result->slug ) ) }}</h4>
            <p><span class="icon icon-sm icon-sm-marker mr5"></span>{{ str_limit($result->venue->address, 24, '...') }}</p>
        </li>
        <li class="list-group-item class-footer">
            <aside class="text-center"><strong class="text-primary">£{{ round($result->default_price ,2)}}</strong></aside>
            <aside class="btn-wrapper">{{ Html::linkRoute('class.show', 'View Class', $result->slug, ['class' => 'btn btn-primary btn-block']) }}</aside>
        </li>
    </div>
</ul>