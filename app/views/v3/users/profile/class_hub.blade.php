@foreach($data['evercisegroups'] as $evercisegroup)
    <div class="container">
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
            <button class="btn btn-blank mb20 toggle-switch" data-toggle="open" data-target="#class1" data-toggled='Close<span class="icon icon-grey-up-arrow"></span>'>Open<span class="icon icon-grey-down-arrow"></span> </button>
        </div>
    </div>
    <!-- button above loads ajax request to 'sessions.inline.groupId' -->
@endforeach
