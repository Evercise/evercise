<div class="row collapse in hub-table-row" >
    <div class="table-responsive col-sm-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Dates</th>
                    <th class="text-center">Time</th>
                    <th class="text-center">Duration</th>
                    <th class="text-center">Tickets</th>
                    <th class="text-center">Price (GBP)</th>
                    <th class="text-center">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
                    <tr class="text-center">
                        <td class="text-left"><span>{{ $session->formattedDate()}}</span></td>
                        <td>{{ $session->formattedTime()}}</td>
                        <td>{{ $session->formattedDuration()}}</td>
                        <td>{{ count($session->sessionmembers).'/'.$session->evercisegroup->capacity}}</td>
                        <td>{{'&pound'. $session->price}}</td>
                        <td class="text-right">
                            <span class="icon icon-mail mr15 hover"></span>
                            <span class="icon icon-download mr15 hover"></span>
                            <span class="icon icon-people mr15 hover"></span>
                            <span class="icon icon-cross ml20 hover"></span>
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
                        <span class="icon icon-plus ml40 hover"></span>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<div class="row  collapse hub-table-row">
    <div class="table-responsive col-sm-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Dates</th>
                    <th class="text-center">Time</th>
                    <th class="text-center">Duration</th>
                    <th class="text-center">Tickets</th>
                    <th class="text-center">Price (GBP)</th>
                    <th class="text-center">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
                    {{ Form::open(['route' => 'home', 'method' => 'put', 'class' => 'update-session']) }}
                    <tr class="text-center">
                        <td class="text-left"><span>{{ $session->formattedDate()}}</span></td>
                        <td>
                            <div class="custom-select">
                                {{ Form::select('time',['15:00' => '15:00','16:00' => '16:00'], '15:00', ['class' => 'form-control input-sm'] ) }}
                            </div>
                        </td>
                        <td>
                            <div class="custom-select">
                                {{ Form::select('duration',['15:00' => '15:00','16:00' => '16:00'], '15:00', ['class' => 'form-control input-sm'] ) }}
                            </div>
                        </td>
                        <td>
                            <div class="custom-select">
                                {{ Form::select('tickets',['15:00' => '15:00','16:00' => '16:00'], '15:00', ['class' => 'form-control input-sm'] ) }}
                            </div>
                        </td>
                        <td>
                            <div class="custom-select">
                                {{ Form::select('price',['15:00' => '15:00','16:00' => '16:00'], '15:00', ['class' => 'form-control input-sm'] ) }}
                            </div>
                        </td>
                        <td class="text-right">
                            <span class="icon icon-mail mr15 hover"></span>
                            <span class="icon icon-download mr15 hover"></span>
                            <span class="icon icon-people mr15 hover"></span>
                            {{ Form::submit('',['class' => 'btn btn-icon icon icon-plus hover ml20']) }}
                        </td>
                    </tr>
                    {{ Form::close() }}
                @endforeach
                <tr class="text-center">
                    <td class="text-left">Add a new date to this class</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right">
                        <span class="icon icon-plus ml40 hover"></span>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>