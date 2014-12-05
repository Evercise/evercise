@if( isset($mode) && $mode == 'user')
    <div class="row hub-table-row" >
        <div class="table-responsive col-sm-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Dates</th>
                        <th class="text-center">Time</th>
                        <th class="text-center">Duration</th>
                        <th class="text-center">Tickets</th>
                        <th class="text-center">Price (GBP)</th>
                        <th class="text-center">{{ (isset($mode) && $mode == 'edit'?  'Options' : '') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $session)
                        <tr class="text-center" id="update-row-{{$session->id}}">
                            <td class="text-left"><span>{{ $session->formattedDate()}}</span></td>
                            <td>{{ $session->formattedTime()}}</td>
                            <td>{{ $session->formattedDuration()}}</td>
                            <td>{{ count($session->sessionmembers).'/'.$session->tickets}}</td>
                            <td>{{'&pound'. $session->price}}</td>
                            <td class="text-right">
                                {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $session->id, 'class' => 'add-to-class']) }}
                                    <span>
                                        <strong class="text-primary mr25 lead">&pound;{{ $session->price }} </strong>
                                    </span>

                                    <div class="btn-group pull-right">
                                        {{ Form::submit('join class', ['class'=> 'btn btn-primary']) }}
                                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $session->id)) }}

                                          <select name="quantity" id="quantity" class="btn btn-primary btn-select">
                                            @for($i=1; $i<($session->tickets - count($session->sessionmembers) + 1 ); $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                          </select>

                                    </div>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="row hub-table-row">
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
                                    {{ Form::select('time', Config::get('evercise.time'), $session->formattedTime(), ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                                </div>
                            </td>
                            <td>
                                <div class="custom-select">
                                    {{ Form::select('duration',Config::get('evercise.duration'),  $session->duration, ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                                </div>
                            </td>
                            <td>
                                <div class="custom-select">
                                    {{ Form::select('tickets',Config::get('evercise.tickets'), $session->tickets , ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                                </div>
                            </td>
                            <td>
                                <div class="custom-select">
                                    {{ Form::select('price',Config::get('evercise.price'), $session->price, ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                                </div>
                            </td>
                            <td class="text-right">
                                 {{ Form::open(['id' => 'remove-session-'.$session->id, 'route' => 'sessions.remove', 'method' => 'post', 'class' => 'remove-session pull-left ml20']) }}
                                    {{ Form::hidden('id', $session->id) }}
                                    {{ Form::submit('',[ 'class' => 'btn btn-icon icon icon-cross hover']) }}
                                {{ Form::close() }}

                                    <a href="{{route('getPdf', ['session_id' => $session->id])}}" class="icon icon-download mr15 hover"></a>
                                    <span class="icon icon-people mr15 hover"></span>
                                {{ Form::open(['id' => 'update-sessions-'.$session->id, 'route' => 'sessions.update', 'method' => 'put', 'class' => 'update-session hidden']) }}
                                    {{ Form::hidden('id', $session->id) }}
                                    {{ Form::submit('',['class' => 'btn btn-icon icon icon-tick hover ml20' , 'form' => 'update-sessions-'.$session->id]) }}
                                {{ Form::close() }}
                            </td>

                        </tr>

                    @endforeach
                    <tr class="text-center">
                        <td class="text-left">
                            <div class="hub-add-td collapse">{{ Form::text('date', date('Y-m-d'), ['class' => 'form-control input-sm date-picker', 'form' => 'add-new-session', 'placeholder' =>'add a date'] ) }}</div>
                            <div class="hub-add-td collapse in">Add a new date to this class</div>
                        </td>
                        <td><div class="hub-add-td collapse">{{ Form::select('time', Config::get('evercise.time'), '12:00', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div></td>
                        <td><div class="hub-add-td collapse">{{ Form::select('duration', Config::get('evercise.duration'), '30', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div></td>
                        <td><div class="hub-add-td collapse">{{ Form::select('members', Config::get('evercise.tickets'), '10', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div></td>
                        <td><div class="hub-add-td collapse">{{ Form::select('price', Config::get('evercise.price'), '10', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div></td>
                        <td class="text-right">
                            {{ Form::open(['id' => 'add-new-session', 'route' => 'sessions.add', 'method' => 'post', 'class' => 'add-session collapse hub-add-td pull-right']) }}

                                {{ Form::hidden('evercisegroupId', $session->evercisegroup->id) }}
                                {{ Form::submit('',['class' => 'btn btn-icon icon icon-tick hover ml20' ]) }}
                            {{ Form::close() }}
                            <button class="btn btn-icon icon icon-plus ml20 hover toggle-switch" data-switchclass="icon-cross" data-removeclass="icon-plus" data-toggle="collapse" data-target=".hub-add-td"></button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endif