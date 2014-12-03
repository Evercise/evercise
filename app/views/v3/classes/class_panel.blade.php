<div id="panel-{{$session->id}}" class="class-panel center-block">
    <div class="row">

        <div class="class-image-wrapper col-xs-4">
            {{ image($session->evercisegroup->user->directory.'/search_'.$session->evercisegroup->image, $session->evercisegroup->name) }}
        </div>
         <div class="class-title-wrapper col-xs-8">
             <a href="/class/{{$session->evercisegroup->id}}"><h3>{{ $session->evercisegroup->name }}</h3></a>
             <div class="mt20">
                <span><span class="icon icon-clock"></span> {{ $session->formattedDate().', '.$session->formattedTime() }}</span>
             </div>

         </div>
    </div>
    @if($session->isInPast())
        @if( ! ($session->sessionmembers[0]->rating))
            <div id="rate-it" class="row panel-body bg-light-grey class-info-wrapper text-center">
                <div class=" col-sm-12">
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
    @endif



    @if($session->isInPast())
        @if(isset($data['next_sessions'][$session->id])) {{-- User has signed up to a future session of this group --}}
            <div id="upcoming-session" class="row panel-body bg-light-grey class-info-wrapper">
                <div class=" col-sm-7">
                    <span><span class="icon icon-clock"></span> {{ $data['future_sessions'][$data['next_sessions'][$session->id]]->formattedDate().', '.$data['future_sessions'][$data['next_sessions'][$session->id]]->formattedTime() }}</span>
                </div>
                <div class=" col-sm-7">
                    <span>Tickets purchased: {{ count($data['future_sessions'][$data['next_sessions'][$session->id]]->userSessionmembers($data['user_id'])) }}</span>
                 </div>
                <div class=" col-sm-5">
                    <div class="row">
                        <div class="col-xs-4">
                            <strong class="text-primary">&pound;{{ $data['future_sessions'][$data['next_sessions'][$session->id]]->price }}</strong>
                        </div>
                        <div class="col-xs-8">
                            <button class="btn btn-default btn-block">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($session->evercisegroup->getNextFutureSession()) {{-- If there is a future session of this group, not signed up to--}}
            <div id="next-session" class="row panel-body bg-light-grey class-info-wrapper">
                <div class=" col-sm-7">
                    <span><span class="icon icon-clock"></span> {{ $session->evercisegroup->getNextFutureSession()->formattedDate().', '.$session->evercisegroup->getNextFutureSession()->formattedTime() }}</span>
                </div>
                <div class=" col-sm-5">
                    <div class="row">
                        <div class="col-xs-4">
                            <strong class="text-primary">&pound;{{$session->evercisegroup->getNextFutureSession()->price}}</strong>
                        </div>
                        <div class="col-xs-8">
                            {{ Form::open(['id' => 'add-to-cart', 'url' => route('cart.add'), 'method' => 'post', 'class' => '']) }}
                                {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $session->id)) }}
                                {{ Form::submit('join class', ['class'=> 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        @else{{-- There are no future sessions of this group --}}
            <div id="no-session" class="row panel-body bg-light-grey class-info-wrapper">
                <div class=" col-sm-7">
                    <span>No other classes available</span>
                 </div>
            </div>
        @endif
    @endif
</div>