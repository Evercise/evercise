<div class="class-panel center-block">
    <div class="row">
    {{ $session->evercisegroup->name }}
        <div class="class-image-wrapper col-xs-4">
            <img src="{{url().'/profiles/'.$session->evercisegroup->user->directory.'/'.$session->evercisegroup->image}}">
        </div>
    </div>
    <div id="rate-it" class="row panel-body bg-light-grey class-info-wrapper text-center {{ (isset($show) && $show == 'rate-it') ? '' : 'hidden' }}">
        <div class=" col-sm-7">
            <span><span class="icon icon-clock"></span> {{ $session->formattedDate().', '.$session->formattedTime() }}</span>
        </div>
        <div class=" col-sm-7">
            <span>Rate it</span>
        </div>
        <br>
        <strong><i class="fa fa-star-o"></i></strong>
        <strong><i class="fa fa-star-o"></i></strong>
        <strong><i class="fa fa-star-o"></i></strong>
        <strong><i class="fa fa-star-o"></i></strong>
        <strong><i class="fa fa-star-o"></i></strong>
        {{ Form::open(['route' => 'ratings.store', 'method' => 'post', 'class'=>'mb50', 'role' => 'form', 'id' => 'rating'] ) }}
            {{ Form::hidden('stars', 3, ['id' => 'stars']) }}
            {{ Form::hidden('sessionmember_id', array_key_exists($session->id, $data['sessionmember_ids']) ? $data['sessionmember_ids'][$session->id] : '', ['id' => 'sessionmember_id']) }}
            <div class="form-group">
                {{Form::textarea('feedback_text', null, ['class' => 'form-control', 'rows' => '6', 'placeholder' => 'Add your review about the class...'])}}
            </div>
            <div class="form-group">
                {{ Form::submit('Cancel', ['class' => 'btn btn-default'] )  }}
                {{ Form::submit('Add Review', ['class' => 'btn btn-primary'] )  }}
            </div>
        {{ Form::close() }}
    </div>
    <div id="user-rating" class="row panel-body bg-light-grey class-info-wrapper {{ (isset($show)  && $show == 'user-rating') ? '' : 'hidden' }} ">
        <div class=" col-sm-7">
            <span><span class="icon icon-clock"></span> {{ $session->formattedDate().', '.$session->formattedTime() }}</span>
        </div>
        <div class="col-sm-12">
            <em><small>You said:</small></em>
        </div>
        <div class="col-sm-12">
            <div class="class-rating-wrapper">
                @for ($i = 0; $i < 5; $i++)
                    <span class="icon icon-{{ $i < $session->userSessionmembers($data['user_id'])[0]->rating['stars'] ? 'full' : 'empty'  }}-star"></span>
                @endfor
            </div>
        </div>
        <div class="col-sm-12">
            <p>{{$session->sessionmembers[0]->rating['comment']}}</p>
        </div>
    </div>
    <div id="next-session" class="row panel-body bg-light-grey class-info-wrapper {{ (isset($show) && $show == 'next-session') ? '' : 'hidden' }}">
        <div class=" col-sm-7">
            <span><span class="icon icon-clock"></span> {{ $session->formattedDate().', '.$session->formattedTime() }}</span>
        </div>
        <div class=" col-sm-5">
            <div class="row">
                <div class="col-xs-4">
                    <strong class="text-primary">&pound;16</strong>
                </div>
                <div class="col-xs-8">
                    <button class="btn btn-default btn-block">Join Class</button>
                </div>
            </div>
        </div>
    </div>
    <div id="upcoming-session" class="row panel-body bg-light-grey class-info-wrapper {{ (isset($show) && $show == 'upcoming-session') ? '' : 'hidden' }}">
        <div class=" col-sm-7">
            <span><span class="icon icon-clock"></span> {{ $session->formattedDate().', '.$session->formattedTime() }}</span>
        </div>
        <div class=" col-sm-7">
            <span>Tickets purchased: {{ count($session->userSessionmembers($data['user_id'])) }}</span>
         </div>
        <div class=" col-sm-5">
            <div class="row">
                <div class="col-xs-4">
                    <strong class="text-primary">&pound;{{ $session->price }}</strong>
                </div>
                <div class="col-xs-8">
                    <button class="btn btn-default btn-block">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div id="no-session" class="row panel-body bg-light-grey class-info-wrapper {{ (isset($show) && $show == 'no-session') ? '' : 'hidden' }}">
        <div class=" col-sm-7">
            <span>No other classes available</span>
         </div>
    </div>
</div>