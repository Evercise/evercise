<div class="class-panel center-block">
    <div class="row">
    {{ $session->evercisegroup->name }}
        <div class="class-image-wrapper col-xs-4">
            <img src="{{url().'/profiles/'.$session->evercisegroup->user->directory.'/'.$session->evercisegroup->image}}">
        </div>
    </div>
    <div id="rate-it" class="row panel-body bg-light-grey class-info-wrapper text-center {{ (isset($show) && $show == 'rate-it') ? '' : 'hidden' }}">
        Rate it
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
        <div class="col-sm-12">
            <em><small>You said:</small></em>

        </div>
        <div class="col-sm-12">
            <div class="class-rating-wrapper">
                <span class="icon icon-full-star"></span>
                <span class="icon icon-full-star"></span>
                <span class="icon icon-full-star"></span>
                <span class="icon icon-full-star"></span>
                <span class="icon icon-full-star"></span>
            </div>
        </div>
        <div class="col-sm-12">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
        </div>
    </div>
    <div id="next-session" class="row panel-body bg-light-grey class-info-wrapper {{ (isset($show) && $show == 'next-session') ? '' : 'hidden' }}">
        <div class=" col-sm-7">
            <span><span class="icon icon-clock"></span> Next class, Sept 27th, 4pm</span>
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
            <span><span class="icon icon-clock"></span> Sept 27th, 4pm</span>
         </div>
        <div class=" col-sm-5">
            <div class="row">
                <div class="col-xs-4">
                    <strong class="text-primary">&pound;16</strong>
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