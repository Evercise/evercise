<div class="class-hub-panel center-block">
    <div class="row">
        <div class="class-image-wrapper col-xs-6">
            <img src="{{url().'/profiles/'.$data['user']->directory.'/'.$evercisegroup->evercisegroup->image}}">
        </div>
        <div class="class-title-wrapper col-xs-6">
            <a href="#"><h3>{{ $evercisegroup->name }}</h3></a>
            <div class="class-rating-wrapper">
                @for($i=0; $i<5; $i++)
                    <span class="icon icon-{{ $i < $evercisegroup->evercisegroup->getStars() ? 'full' : 'empty'  }}-star"></span>
                @endfor
            </div>
            <button class="btn btn-default mr15">Clone Class</button>
            <button id="edit-{{$evercisegroup->id}}" class="btn btn-default toggle-switch disabled" data-toggle="collapse" data-target=".hub-table-row" data-removeclass="btn-default" data-switchclass="btn-transparent-grey" data-switchtext="Done Editing">Edit Class</button>
        </div>
    </div>
</div>