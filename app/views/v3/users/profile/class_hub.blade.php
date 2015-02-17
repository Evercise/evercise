@foreach($groups as $index => $evercisegroup)
    <div class="container hub-row {{ $index + 1 == count((array)$evercisegroup) ? 'last' : null }}" >
            <div class="row mt40">
                <div class="col-sm-8">
                    @include('v3.classes.class_hub_panel', ['type' => 's', 'addressInsteadOfStars' => 1])
                </div>

                <div class="col-sm-4 sm-text-center">
                    <ul class="list-unstyled mt25">
                        <strong class="text-dark">Class Stats</strong>
                        <li>Past Dates: <strong class="text-primary">{{ count($evercisegroup->pastsessions) }}</strong> </li>
                        <li>Upcoming Dates: <strong class="text-primary">{{ count($evercisegroup->futuresessions) }}</strong> </li>
                        <li>Places Filled: <strong class="text-primary">{{ $evercisegroup->placesFilled() }} </strong> </li>
                        <li>Average Class Booking: <strong class="text-primary">{{ $evercisegroup->averageClassBooking() }}</strong> </li>
                    </ul>
                </div>
            </div>
    </div>

    <div id="myClassInfo-{{ $evercisegroup->id }}" class="container-fluid bg-grey collapse ">
        <div id="{{ $evercisegroup->id }}" class="container">
            <!-- button above loads ajax request to 'sessions.inline.groupId' and appends here-->
        </div>
    </div>
@endforeach

