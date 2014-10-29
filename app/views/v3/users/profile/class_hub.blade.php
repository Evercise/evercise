<div class="container">

    @foreach($data['evercisegroups'] as $evercisegroup)
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
    @endforeach

    <div class="col12 text-right">
        <button class="btn btn-blank mb20 toggle-switch" data-toggle="open" data-target="#class1" data-toggled='Close<span class="icon icon-grey-up-arrow"></span>'>Open<span class="icon icon-grey-down-arrow"></span> </button>
    </div>
</div>

<div id="class1" class="container-fluid bg-grey collapse">
    <div class="container">
        <div class="row">
            <div class="table-responsive col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Dates</th>
                            <th class="text-center">Time</th>
                            <th class="text-center">Duration</th>
                            <th class="text-center">Tickets</th>
                            <th class="text-center">Price(GBP)</th>
                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="text-left"><span>Mon Sept 1st 2014</span></td>

                            <td>

                                <div class="custom-select">
                                {{ Form::select('phone',['15:00' => '15:00','16:00' => '16:00'], '15:00', ['class' => 'form-control input-sm'] ) }}
                                </div>

                            </td>
                            <td><span class="ml30 mr30">30 mins</span></td>
                            <td><span class="ml30 mr30">10/10</span></td>
                            <td><span class="ml30 mr30">£15.00</span></td>
                            <td class="text-right">
                                <span class="icon icon-mail mr15 hover"></span>
                                <span class="icon icon-download mr15 hover"></span>
                                <span class="icon icon-people mr15 hover"></span>
                                <span class="icon icon-cross ml40 hover"></span>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left"><span>Mon Sept 15th 2014</span></td>
                            <td><span class="ml30 mr30">11:00</span></td>
                            <td><span class="ml30 mr30">45 mins</span></td>
                            <td><span class="ml30 mr30">0/10</span></td>
                            <td><span class="ml30 mr30">£14.00</span></td>
                            <td class="text-right">
                                <span class="icon icon-mail mr15 hover"></span>
                                <span class="icon icon-download mr15 hover"></span>
                                <span class="icon icon-people mr15 hover"></span>
                                <span class="icon icon-cross ml40 hover"></span>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Add a new date to this class</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">
                                <span class="icon icon-cross ml40 hover"></span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>