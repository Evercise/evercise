<div class="row mb50">
    <div class="col-sm-11">
        <div class="row">
            <div class="col-sm-3">
                {{ HTML::image('profiles/'.$rating['rator']['directory'].'/'.$rating['rator']['image'],  $rating['rator']['display_name']  , array('title' => $rating['rator']['display_name'] ,'class' => 'img-responsive img-circle')) }}
            </div>
            <div class="col-sm-9 mt15">
                <div class="condensed">
                    <strong>{{ $rating['rator']['display_name'] }}</strong>
                </div>

                <i>{{ date('d/m/Y' , strtotime($rating['created_at']))}}</i>
                <div class="mb25">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="icon icon-{{ $i < $rating['stars'] ? 'full' : 'empty'  }}-star"></span>
                    @endfor
                </div>
                <p>{{ $rating['comment'] }}</p>
            </div>
        </div>
    </div>
</div>