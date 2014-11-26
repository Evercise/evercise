<div class="class-hub-panel center-block">
    <div class="row">
        <div class="class-image-wrapper col-xs-6">
            {{ image( $evercisegroup->user->directory.'/search_'.$evercisegroup->image) }}
        </div>
        <div class="class-title-wrapper col-xs-6">
            <a href="#"><h3>{{ $evercisegroup->name }}</h3></a>
            <div class="class-rating-wrapper">
                @for($i=0; $i<5; $i++)
                    <span class="icon icon-{{ $i < $evercisegroup->getStars() ? 'full' : 'empty'  }}-star"></span>
                @endfor
            </div>

            @if( isset($mode) && $mode != 'user')
                <button class="btn btn-default mr15">Clone Class</button>
                <button id="edit-{{$evercisegroup->id}}" class="btn btn-default toggle-switch disabled" data-toggle="collapse" data-target=".hub-table-row" data-removeclass="btn-default" data-switchclass="btn-transparent-grey" data-switchtext="Done Editing">Edit Class</button>
            @else
                <div class="mt40">
                    <strong class="mr20">Share this class:</strong>
                    <span>
                        <a href="{{ Share::load(Request::url() , $evercisegroup->name)->facebook()  }}" target="_blank"><span class="icon icon-fb mr20 hover"></span> </a>
                        <a href="{{ Share::load(Request::url() , $evercisegroup->name)->twitter()  }}" target="_blank"><span class="icon icon-twitter mr20 hover"></span> </a>
                        <a href="{{ Share::load(Request::url() , $evercisegroup->name)->gplus()  }}" target="_blank"><span class="icon icon-google hover"></span> </a>
                    </span>
                </div>

            @endif
        </div>
    </div>
</div>