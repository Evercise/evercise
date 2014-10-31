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

                    <tr class="text-center" id="hub-edit-row-{{$session->id}}">

                        <td class="text-left"><span>{{ $session->formattedDate()}}</span></td>
                        <td>
                            <div class="custom-select">
                                {{ Form::select('time', Config::get('evercise.time'), $session->formattedTime(), ['class' => 'form-control input-sm', 'form' => 'update-sessions-'.$session->id] ) }}
                            </div>
                        </td>
                        <td>
                            <div class="custom-select">
                                {{ Form::select('duration',Config::get('evercise.duration'),  $session->duration, ['class' => 'form-control input-sm', 'form' => 'update-sessions-'.$session->id] ) }}
                            </div>
                        </td>
                        <td>
                            <div class="custom-select">
                                {{ Form::select('members',Config::get('evercise.tickets'), $session->evercisegroup->capacity , ['class' => 'form-control input-sm', 'form' => 'update-sessions-'.$session->id] ) }}
                            </div>
                        </td>
                        <td>
                            <div class="custom-select">
                                {{ Form::select('price',Config::get('evercise.price'), $session->price, ['class' => 'form-control input-sm', 'form' => 'update-sessions-'.$session->id] ) }}
                            </div>
                        </td>
                        <td class="text-right">
                            {{ Form::open(['id' => 'update-sessions-'.$session->id, 'route' => 'sessions.update', 'method' => 'put', 'class' => 'update-session']) }}
                                <span class="icon icon-mail mr15 hover"></span>
                                <span class="icon icon-download mr15 hover"></span>
                                <span class="icon icon-people mr15 hover"></span>

                                {{ Form::hidden('id', $session->id) }}
                                {{ Form::submit('',['class' => 'btn btn-icon icon icon-tick hover ml20' , 'form' => 'update-sessions-'.$session->id]) }}
                            {{ Form::close() }}
                        </td>

                    </tr>

                @endforeach
                <tr class="text-center">
                    <td class="text-left">
                        <div class="hub-add-td collapse">{{ Form::text('date', null, ['class' => 'form-control input-sm date-picker', 'form' => 'add-new-session', 'placeholder' =>'add a date'] ) }}</div>
                        <div class="hub-add-td collapse in">Add a new date to this class</div>
                    </td>
                    <td><div class="hub-add-td collapse">{{ Form::select('time', Config::get('evercise.time'), '12:00', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div></td>
                    <td><div class="hub-add-td collapse">{{ Form::select('duration', Config::get('evercise.duration'), '30', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div></td>
                    <td><div class="hub-add-td collapse">{{ Form::select('members', Config::get('evercise.tickets'), '10', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div></td>
                    <td><div class="hub-add-td collapse">{{ Form::select('price', Config::get('evercise.price'), '10', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div></td>
                    <td class="text-right">
                        {{ Form::open(['id' => 'add-new-session', 'route' => 'home', 'method' => 'post', 'class' => 'add-session  collapse hub-add-td pull-right']) }}

                            {{ Form::hidden('id', $session->evercisegroup->id) }}
                            {{ Form::submit('',['class' => 'btn btn-icon icon icon-tick hover ml20' ]) }}
                        {{ Form::close() }}
                        <button class="btn btn-icon icon icon-plus ml20 hover toggle-switch" data-switchclass="icon-cross" data-removeclass="icon-plus" data-toggle="collapse" data-target=".hub-add-td"></button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>