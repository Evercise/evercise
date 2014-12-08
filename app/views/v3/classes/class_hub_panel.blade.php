<div class="class-hub-panel center-block">
    <div class="row">
        <div class="class-image-wrapper pull-left">
            {{ image( $evercisegroup->user->directory.'/preview_'.$evercisegroup->image) }}
        </div>
        <div class="class-title-wrapper pull-left">
            <a href="{{ URL::route('class.show', [$evercisegroup->slug]) }}"><h3>{{ $evercisegroup->name }}</h3></a>
            <div class="class-rating-wrapper">
                @for($i=0; $i<5; $i++)
                    <span class="icon icon-{{ $i < $evercisegroup->getStars() ? 'full' : 'empty'  }}-star"></span>
                @endfor
            </div>

            @if( isset($mode) && $mode == 'user')
                <div class="mt40">
                    <strong class="mr20">Share this class:</strong>
                    <span>
                        <a href="{{ Share::load(Request::url() , $evercisegroup->name)->facebook()  }}" target="_blank"><span class="icon icon-fb mr20 hover"></span> </a>
                        <a href="{{ Share::load(Request::url() , $evercisegroup->name)->twitter()  }}" target="_blank"><span class="icon icon-twitter mr20 hover"></span> </a>
                        <a href="{{ Share::load(Request::url() , $evercisegroup->name)->gplus()  }}" target="_blank"><span class="icon icon-google hover"></span> </a>
                    </span>
                </div>

            @else
                {{ Form::open(['route' => 'sessions.inline.groupId', 'method' => 'post', 'class'=> 'edit-class-inline']) }}
                    {{  Form::hidden('groupId',$evercisegroup->id ) }}
                    {{  Form::hidden('id',  isset($data['trainer']->user->id) ? $data['trainer']->user->id : $data['user']->id ) }}
                    {{ Html::linkRoute('clone_class', 'Clone Class', $evercisegroup->id, ['class' => 'btn btn-default']) }}
                    <!-- need to use html button as btn-toggle class does not work with input field -->
                    <button type="submit" id="submit-{{$evercisegroup->id}}" class="btn btn-default btn-toggle-down {{ empty($evercisegroup->futuresessions) ? 'disabled' : null }}">Edit</button>
                    {{ HTML::link('#myClassInfo-'.$evercisegroup->id , 'Done editing', [ 'class' => 'btn btn-default btn-toggle-up hide toggle-switch' , 'data-toggle' =>'collapse', 'id' => 'infoToggle-'.$evercisegroup->id , 'data-removeclass'=>'btn-toggle-up' ,  'data-switchclass' => 'btn-toggle-down' , 'data-switchtext' => 'Edit']) }}
                    <a class="btn btn-info" href="{{ URL::route('class.show', [$evercisegroup->slug]) }}">Preview</a>
                {{ Form::close() }}
            @endif
        </div>
    </div>

</div>