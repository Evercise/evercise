<div id="panel-{{$session->id}}" class="class-panel center-block">
    <div class="row">

        <div class="class-image-wrapper col-xs-4">
            {{ image($session->evercisegroup->user->directory.'/search_'.$session->evercisegroup->image, $session->evercisegroup->name) }}
        </div>
         <div class="class-title-wrapper col-xs-8">
             <a href="#"><h3>{{ $session->evercisegroup->name }}</h3></a>
             <div class="mt20">
                <span><span class="icon icon-clock"></span> {{ $session->formattedDate().', '.$session->formattedTime() }}</span>
             </div>

         </div>
    </div>
    @if( empty($session->sessionmembers[0]->rating))
        <div id="rate-it" class="row panel-body bg-light-grey class-info-wrapper text-center">
            <div cla ss=" col-sm-12">
                <span>Rate it</span>
            </div>
            <div class="rate-it">
                 <div class="mb40 col-sm-12">
                     <span class="icon icon-empty-star"></span>
                     <span class="icon icon-empty-star"></span>
                     <span class="icon icon-empty-star"></span>
                     <span class="icon icon-empty-star"></span>
                     <span class="icon icon-empty-star"></span>
                 </div>

                {{ Form::open(['route' => 'ratings.store', 'method' => 'post', 'class'=>'mb50', 'role' => 'form', 'id' => 'rating-'.$session->id] ) }}
                    {{ Form::hidden('stars', null, ['id' => 'stars']) }}
                    {{ Form::hidden('sessionmember_id', array_key_exists($session->id, $data['sessionmember_ids']) ? $data['sessionmember_ids'][$session->id] : '', ['id' => 'sessionmember_id']) }}
                    <div class="form-group pull-left">
                        {{Form::textarea('feedback_text', null, ['class' => 'form-control', 'rows' => '8', 'placeholder' => 'Add your review about the class...'])}}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default" type="button">Cancel</button>
                        {{ Form::submit('Add Review', ['class' => 'btn btn-primary'] )  }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    @else
        <div id="user-rating" class="row panel-body bg-light-grey class-info-wrapper">
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
    @endif
    @if($session->sessionmembers[0]->rating)
        <div id="next-session" class="row panel-body bg-light-grey class-info-wrapper">
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
    @else

        <div id="no-session" class="row panel-body bg-light-grey class-info-wrapper">
            <div class=" col-sm-7">
                <span>No other classes available</span>
             </div>
        </div>
    @endif

    <div id="upcoming-session" class="row panel-body bg-light-grey class-info-wrapper">
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
</div>