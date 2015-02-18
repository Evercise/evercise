<div class="class-hub-panel center-block">
    <div class="row">
        <div class="class-image-wrapper col-sm-4">
            <a href="{{ URL::route('class.show', [$evercisegroup->slug]) }}">{{ image( $evercisegroup->user->directory.'/preview_'.$evercisegroup->image) }}</a>
        </div>
        <div class="class-title-wrapper col-sm-8">
            <a href="{{ URL::route('class.show', [$evercisegroup->slug]) }}"><h2 class="h3">{{ $evercisegroup->name }}</h2></a>
            @if(isset($addressInsteadOfStars))
                <ul class="list-unstyled">
                    <li>{{ $evercisegroup->venue->address }}</li>
                    <li>{{ $evercisegroup->venue->town . ' ' . $evercisegroup->venue->postcode }}</li>
                </ul>
            @else
            <div class="class-rating-wrapper">
                @for($i=0; $i<5; $i++)
                    <span class="icon icon-{{ $i < $evercisegroup->getStars() ? 'full' : 'empty'  }}-star"></span>
                @endfor
            </div>
            @endif

            @if( isset($mode) && $mode == 'user')
                <div>
                    <strong class="mr20">Share this class:</strong>
                    <span>
                        <a href="{{  Share::load(URL::to('class/'.$evercisegroup->slug)  , $evercisegroup->name)->facebook()   }}" target="_blank"><span class="icon icon-fb mr20 hover"></span> </a>
                        <a href="{{ Share::load(URL::to('class/'.$evercisegroup->slug)  , $evercisegroup->name)->twitter()  }}" target="_blank"><span class="icon icon-twitter mr20 hover"></span> </a>
                        <a href="{{Share::load(URL::to('class/'.$evercisegroup->slug)  , $evercisegroup->name)->gplus()  }}" target="_blank"><span class="icon icon-google hover"></span> </a>
                    </span>
                </div>

            @else
                {{ Form::open(['route' => 'sessions.inline.groupId', 'method' => 'post', 'class'=> 'edit-class-inline']) }}
                    <div class="row">
                        {{  Form::hidden('groupId',$evercisegroup->id ) }}
                        {{  Form::hidden('id',  isset($data['trainer']->user->id) ? $data['trainer']->user->id : $data['user']->id ) }}
                        <div class="col-sm-4">
                            {{ Html::linkRoute('clone_class', 'Clone Class', $evercisegroup->id, ['class' => 'btn btn-default btn-block']) }}
                        </div>

                        @if(count($evercisegroup->futuresessions) == 0)
                            <div class="col-sm-4">
                                {{ Html::linkRoute('sessions.add', 'Add Dates', $evercisegroup->id ,['class' => 'btn btn-primary btn-block']) }}
                            </div>
                        @else
                            <div class="col-sm-4">
                                <a class="btn btn-block btn-default" href="{{ URL::route('class.show', [$evercisegroup->slug]) }}">Preview</a>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" id="submit-{{$evercisegroup->id}}" class="btn btn-default btn-block btn-toggle-down">Manage</button>
                                {{ HTML::link('#myClassInfo-'.$evercisegroup->id , 'Done', [ 'class' => 'btn btn-default btn-block btn-toggle-up hide toggle-switch' , 'data-toggle' =>'collapse', 'id' => 'infoToggle-'.$evercisegroup->id , 'data-removeclass'=>'btn-toggle-up' ,  'data-switchclass' => 'btn-toggle-down' , 'data-switchtext' => 'Manage']) }}
                            </div>

                        @endif
                    </div>
                {{ Form::close() }}
            @endif
        </div>
    </div>

</div>