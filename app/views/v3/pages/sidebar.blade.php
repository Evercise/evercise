 <div class="col-sm-4">

        <div class="list-group-accordion" id="list-accordion">

            <div class="list-group-accordion-body">
              <div class="list-group-accordion-title">
                  <a data-toggle="collapse" data-parent="#list-accordion" href="#categories" class="">Categories</a>
              </div>
              <div id="categories" class="panel-collapse collapse">
                <div class="list-group">
                    @foreach($categories as $c)
                        @if($c->title != 'Information')
                            <li class="list-group-item bg-grey">
                                {{ Html::link(url($c->permalink), $c->title) }}
                            </li>
                        @endif
                    @endforeach
              </div>
            </div>
            <div class="list-group-accordion-body">
              <div class="list-group-accordion-title">
                  <a data-toggle="collapse" data-parent="#list-accordion" href="#posts" class="">Latest Posts</a>
              </div>
              <div id="posts" class="panel-collapse collapse">
                <div class="list-group">
                @foreach($articles_latest as $latest)
                    <li class="list-group-item bg-grey">
                            {{ Html::link(url(Articles::createUrl($latest)), $latest->title) }}
                     </li>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </div>
</div>