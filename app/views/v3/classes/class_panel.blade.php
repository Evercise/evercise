<div id="panel-{{$session->id}}" class="class-panel center-block">
    <div class="row sm-mb20">

        <div class="class-image-wrapper col-sm-4 sm-text-center">
            {{ image($session->evercisegroup->user->directory.'/search_'.$session->evercisegroup->image, $session->evercisegroup->name) }}
        </div>
         <div class="class-title-wrapper col-sm-8 sm-text-center">
            <div class="row">
                <div class="col-sm-10">
                    <a href="{{ URL::route('class.show', [$session->evercisegroup->slug]) }}"><h3>{{ $session->evercisegroup->name }}</h3></a>
                </div>
                <div class="col-sm-2">
                    {{ HTML::linkRoute('sessions.mail_trainer', '', ['sessionId'=>$session->id, 'trainerId' => $session->evercisegroup->user_id], ['class'=>'icon icon-mail mt25 mail-popup', 'id' => 'mail-popup', 'data-id' =>$session->id ]) }}
                </div>
            </div>



             <div class="mt20">
                <span><span class="icon icon-clock"></span> {{ $session->formattedDate().', '.$session->formattedTime() }}</span><br>


             </div>

         </div>
    </div>
    @if($session->isInPast())
        @if( ! ($rating = $session->userRating($data['user_id'])))
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

                    {{ Form::open(['route' => 'ratings.store', 'method' => 'post', 'class'=>'mb50 pull-left', 'role' => 'form', 'id' => 'rating-'.$session->id] ) }}
                        {{ Form::hidden('stars', null, ['id' => 'stars']) }}
                        {{ Form::hidden('sessionmember_id', array_key_exists($session->id, $data['sessionmember_ids']) ? $data['sessionmember_ids'][$session->id] : '', ['id' => 'sessionmember_id']) }}
                        <div class="form-group">
                            {{Form::textarea('feedback_text', null, ['class' => 'form-control', 'rows' => '8', 'placeholder' => 'Add your review about the class...'])}}
                        </div>
                        <div class="form-group">
                            <!--<button class="btn btn-default" type="button">Cancel</button>-->
                            {{ Form::submit('Add Review', ['class' => 'btn btn-primary sm-btn-block'] )  }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        @else
            <div id="user-rating" class="row panel-body bg-light-grey class-info-wrapper">
                <div class=" col-sm-7">
                    <span><span class="icon icon-clock"></span> {{ $session->formattedDate().', '.$session->formattedTime() }}</span>
                </div>
                <div class="col-sm-12 mt10">
                    <em><small>You said:</small></em>
                </div>
                <div class="col-sm-12">
                    <div class="class-rating-wrapper mt5">
                        @for ($i = 0; $i < 5; $i++)
                            <span class="icon icon-{{ $i < $rating['stars'] ? 'full' : 'empty'  }}-star"></span>
                        @endfor
                    </div>
                </div>
                <div class="col-sm-12">
                    <p>{{$rating['comment']}}</p>
                </div>
            </div>
        @endif
    @endif



    @if($session->isInPast())
        @if(isset($data['next_sessions'][$session->id])) {{-- User has signed up to a future session of this group --}}
            <div id="upcoming-session" class="row panel-body bg-light-grey class-info-wrapper">
                <div class=" col-sm-7 sm-text-center">
                    <span><span class="icon icon-clock"></span> {{ $data['future_sessions'][$data['next_sessions'][$session->id]]->formattedDate().', '.$data['future_sessions'][$data['next_sessions'][$session->id]]->formattedTime() }}</span><br>
                    <span><span class="icon icon-ticket"></span> Tickets purchased: {{ count($data['future_sessions'][$data['next_sessions'][$session->id]]->userSessionmembers($data['user_id'])) }}</span>
                </div>

                <div class=" col-sm-5 text-right sm-text-center">
                    <strong class="text-primary">&pound;{{ $data['future_sessions'][$data['next_sessions'][$session->id]]->price }}</strong>
                </div>
            </div>
        @elseif($session->evercisegroup->getNextFutureSession()) {{-- If there is a future session of this group, not signed up to--}}
            <div id="next-session" class="row panel-body bg-light-grey class-info-wrapper">
                <div class=" col-sm-5 sm-text-center mt10">
                    <span><span class="icon icon-clock"></span> {{ $session->evercisegroup->getNextFutureSession()->formattedDate().', '.$session->evercisegroup->getNextFutureSession()->formattedTime() }}</span>
                </div>
                <div class=" col-sm-7">
                    <div class="row">
                        <div class="col-sm-3 sm-text-center">
                            <strong class="text-primary">&pound;{{$session->evercisegroup->getNextFutureSession()->price}}</strong>
                        </div>
                        <div class="col-sm-9 sm-text-center">
                            @if($session->remainingTickets()  > 0)
                                {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $session->id, 'class' => 'add-to-class']) }}
                                    <div class="btn-group btn-block">
                                        {{ Form::submit('Join class', ['class'=> 'btn btn-primary add-btn']) }}
                                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $session->id)) }}
                                        <div class="btn btn-primary btn-aside">
                                            <div class="custom-select">
                                                <select name="quantity" id="quantity" class="btn-primary btn-select ">
                                                    @for($i=1; $i<($session->remainingTickets()  + 1 ); $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                 </select>
                                            </div>

                                        </div>
                                    </div>
                                {{ Form::close() }}
                            @else
                                <span class="text-danger">Class Full</span>
                                <span class="text-danger">Class Full</span>
                            @endif
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