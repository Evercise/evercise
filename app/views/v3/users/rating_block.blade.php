
<div class="row mb50">
    <div class="col-sm-11">
        <div class="row">
            <div class="col-sm-3">
                {{ image($rating->image,  $rating->name  , array('title' => $rating->name ,'class' => 'img-responsive img-circle')) }}
            </div>
            <div class="col-sm-9 mt15">
                <div class="condensed">
                    <strong>{{ $rating->name }}</strong>
                </div>

                <i>{{ $rating->date_left }}</i>
                <div class="mb25">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="icon icon-{{ $i < $rating->stars ? 'full' : 'empty'  }}-star"></span>
                    @endfor
                </div>
                <p>{{ $rating->comment }}</p>
            </div>
        </div>
    </div>
</div>