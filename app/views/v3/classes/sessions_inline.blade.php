
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
                        @foreach($sessions as $session)
                            <tr class="text-center">
                                <td class="text-left"><span>{{ $session->formattedDate()}}</span></td>
                                <td>
                                    <span class="ml30 mr30">{{ $session->formattedTime()}}</span>
                                    <div class="custom-select">
                                    {{ Form::select('phone',['15:00' => '15:00','16:00' => '16:00'], '15:00', ['class' => 'form-control input-sm'] ) }}
                                    </div>
                                </td>
                                <td><span class="ml30 mr30">{{ $session->formattedDuration()}}</span></td>
                                <td><span class="ml30 mr30">{{ count($session->sessionmembers).'/'.$session->evercisegroup->capacity}}</span></td>
                                <td><span class="ml30 mr30">{{'£'. $session->price}}</span></td>
                                <td class="text-right">
                                    <span class="icon icon-mail mr15 hover"></span>
                                    <span class="icon icon-download mr15 hover"></span>
                                    <span class="icon icon-people mr15 hover"></span>
                                    <span class="icon icon-cross ml40 hover"></span>
                                </td>
                            </tr>
                        @endforeach
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