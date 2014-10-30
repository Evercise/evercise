@foreach($data['evercisegroups'] as $evercisegroup)
    <div class="container hub-row" >
            <div class="row mt40">
                <div class="col-sm-8">
                    @include('v3.classes.class_hub_panel', ['type' => 's'])
                </div>

                <div class="col-sm-4">
                    <ul class="list-unstyled mt25">
                        <strong class="text-dark">Class Stats</strong>
                        <li>Past Dates: <strong class="text-primary">{{ count($evercisegroup->pastsessions) }}</strong> </li>
                        <li>Upcoming Dates: <strong class="text-primary">{{ count($evercisegroup->futuresessions) }}</strong> </li>
                        <li>Places Filled: <strong class="text-primary">{{ $evercisegroup->placesFilled() }} </strong> </li>
                        <li>Average Class Booking: <strong class="text-primary">{{ $evercisegroup->averageClassBooking() }}</strong> </li>
                    </ul>
                </div>
            </div>

        <div class="col12 text-right">
            {{ Form::open(['route' => 'sessions.inline.groupId', 'method' => 'post', 'class'=> 'edit-class-inline']) }}
                {{  Form::hidden('groupId',$evercisegroup->id ) }}
                {{ HTML::link('#myClassInfo-'.$evercisegroup->id , 'toggle', [ 'class' => 'btn btn-blank mb20 hide' , 'data-toggle' =>'collapse', 'id' => 'infoToggle-'.$evercisegroup->id]) }}
                {{  Form::submit('Open' , [ 'class' => 'btn btn-blank mb20', 'id' => 'submit-'.$evercisegroup->id]) }}
            {{ Form::close() }}
        </div>
    </div>

    <div id="myClassInfo-{{ $evercisegroup->id }}" class="container-fluid bg-grey collapse ">
        <div id="{{ $evercisegroup->id }}" class="container">
            <!-- button above loads ajax request to 'sessions.inline.groupId' and appends here-->
        </div>
    </div>
@endforeach


