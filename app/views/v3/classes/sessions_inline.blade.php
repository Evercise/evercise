@if( isset($mode) && $mode == 'user')
    <div class="row hub-table-row mt10 mb10" id="hub-edit-row-{{$session->id}}">
        <div class="col-md-2">
            <div class="row sm-mb10">
                <div class="col-xs-12 sm-text-center mt5">
                    <strong>{{ $session->formattedDate()}}</strong>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="row sm-mb10">
                <div class="col-xs-6">
                    <div class="custom-select bg-white">
                        {{ Form::select('time', Config::get('evercise.time'), $session->formattedTime(), ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="custom-select bg-white">
                        {{ Form::select('duration',Config::get('evercise.duration'),  $session->duration, ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="row sm-mb10">
                <div class="col-xs-6">
                    <div class="custom-select bg-white">
                        {{ Form::select('tickets',Config::get('evercise.tickets'), $session->tickets , ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="custom-select bg-white">
                        {{ Form::select('price',Config::get('evercise.price'), $session->price, ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-2">
            <div class="row sm-mb10">
                <div class="col-xs-12">
                    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $session->id, 'class' => 'add-to-class']) }}
                        <div class="btn-group pull-right">
                            {{ Form::submit('join class', ['class'=> 'btn btn-primary']) }}
                            {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $session->id)) }}

                              <select name="quantity" id="quantity" class="btn btn-primary btn-select">
                                @for($i=1; $i<($session->tickets - count($session->sessionmembers) + 1 ); $i++)
                                <option value="{{$i}}" {{ (!empty($cart_items[$session->id]) && $cart_items[$session->id] == $i ? 'selected="selected"' : '') }}>{{$i}}</option>
                                @endfor
                              </select>

                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@else
    @foreach($sessions as $session)
        <div class="row hub-table-row mt10 mb10" id="hub-edit-row-{{$session->id}}">
            <div class="col-md-3">
                <div class="row sm-mb10">
                    <div class="col-xs-12 sm-text-center mt5">
                        <strong>{{ $session->formattedDate()}}</strong>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="row sm-mb10">
                    <div class="col-xs-6 text-center">
                        @if($session->sessionmembers()->count() == 0)
                        <div class="custom-select bg-white">
                                {{ Form::select('time', Config::get('evercise.time'), $session->formattedTime(), ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                        </div>
                        @else
                            <div class="mt5">
                                {{ $session->formattedTime()}}
                            </div>

                        @endif
                    </div>
                    <div class="col-xs-6 text-center">
                        @if($session->sessionmembers()->count() == 0)
                            <div class="custom-select bg-white">
                                {{ Form::select('duration',Config::get('evercise.duration'),  $session->duration, ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                            </div>
                        @else
                            <div class="mt5">
                                {{ $session->formattedDuration()}}
                            </div>
                        @endif

                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="row sm-mb10">
                    <div class="col-xs-6 text-center">
                        @if($session->sessionmembers()->count() == 0)
                            <div class="custom-select bg-white">
                                {{ Form::select('tickets',Config::get('evercise.tickets'), $session->tickets , ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                            </div>
                        @else
                            <div class="mt5">
                                <strong>{{ $session->sessionmembers()->count().'/'.$session->tickets}}</strong>
                            </div>

                        @endif

                    </div>
                    <div class="col-xs-6 text-center">
                        @if($session->sessionmembers()->count() == 0)
                            <div class="custom-select bg-white">
                                {{ Form::select('price',Config::get('evercise.price'), $session->price, ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                            </div>
                        @else
                            <div class="mt5">
                                {{'&pound'. $session->price}}
                            </div>

                        @endif
                    </div>

                </div>
            </div>
            <div class="col-md-1">
                <div class="row sm-mb10">
                    @if($session->sessionmembers()->count() == 0)
                        <div class="col-xs-12 mt5 text-right">
                            {{ Form::open(['id' => 'remove-session-'.$session->id, 'route' => 'sessions.remove', 'method' => 'post', 'class' => 'remove-session']) }}
                                {{ Form::hidden('id', $session->id) }}
                                {{ Form::submit('',[ 'class' => 'btn btn-icon icon icon-cross hover hidden-mob']) }}
                                {{ Form::submit('Remove',[ 'class' => 'btn btn-light hidden-lg hidden-md btn-block']) }}
                            {{ Form::close() }}

                            {{ Form::open(['id' => 'update-sessions-'.$session->id, 'route' => 'sessions.update', 'method' => 'put', 'class' => 'update-session hidden']) }}
                                {{ Form::hidden('id', $session->id) }}
                                {{ Form::submit('',['class' => 'btn btn-icon icon icon-tick hover ml20' , 'form' => 'update-sessions-'.$session->id]) }}
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="col-xs-12 mt5 text-right hidden-mob">
                            {{ Form::open(['route'=>'session.get.members', 'method'=> 'post', 'class' => 'get-members', 'id'=>'get-members']) }}
                                <a href="{{route('getPdf', ['session_id' => $session->id])}}" class="icon icon-download mr10 hover"></a>
                                {{ Form::hidden('session_id', $session->id) }}
                                {{ Form::submit('', ['class' => 'icon btn-icon icon-people hover']) }}
                            {{ Form::close() }}
                        </div>
                        <div class="hidden-md hidden-lg">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="{{route('getPdf', ['session_id' => $session->id])}}" class="btn btn-info btn-block">PDF</a>
                                </div>
                                <div class="col-xs-6">
                                    {{ Form::open(['route'=>'session.get.members', 'method'=> 'post', 'class' => 'get-members', 'id'=>'get-members']) }}
                                        {{ Form::hidden('session_id', $session->id) }}
                                        {{ Form::submit('ppl List', ['class' => 'btn btn-light btn-block']) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
        <div class="row mt20 mb20">
            <div class="col-md-3">
                <div class="hub-add-td collapse mb10">{{ Form::text('date', date('Y-m-d'), ['class' => 'form-control input-sm date-picker', 'form' => 'add-new-session', 'placeholder' =>'add a date'] ) }}</div>
                <div class="hub-add-td collapse in"><strong>Add a new date to this class</strong></div>
            </div>
            <div class="col-md-4">
                <div class="row mb10">
                    <div class="hub-add-td collapse col-xs-6">
                        {{ Form::select('time', Config::get('evercise.time'), '12:00', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}
                    </div>
                    <div class="hub-add-td collapse col-xs-6">{{ Form::select('duration', Config::get('evercise.duration'), '30', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="row mb10">
                    <div class="hub-add-td collapse col-xs-6">{{ Form::select('members', Config::get('evercise.tickets'), '10', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div>
                    <div class="hub-add-td collapse col-xs-6">{{ Form::select('price', Config::get('evercise.price'), '10', ['class' => 'form-control input-sm', 'form' => 'add-new-session'] ) }}</div>
                </div>

            </div>
            <div class="col-md-1">
                <div class="row mb10">
                    <div class="col-xs-6">

                        {{ Form::open(['id' => 'add-new-session', 'route' => 'sessions.store', 'method' => 'post', 'class' => 'add-session collapse hub-add-td']) }}
                            {{ Form::hidden('evercisegroupId', $evercisegroup_id) }}
                            {{ Form::submit('',['class' => 'btn btn-icon icon icon-tick hover hidden-mob' ]) }}
                            {{ Form::submit('Save',[ 'class' => 'btn btn-primary hidden-lg hidden-md btn-block']) }}
                        {{ Form::close() }}

                    </div>
                    <div class="col-xs-6 text-right">
                         <button class="hidden-mob btn btn-icon icon icon-plus hover toggle-switch" data-switchclass="icon-cross" data-removeclass="icon-plus" data-toggle="collapse" data-target=".hub-add-td"></button>
                         <button class=" hidden-lg hidden-md btn btn-block btn-light toggle-switch" data-toggle="collapse" data-switchtext="Cancel" data-target=".hub-add-td">Add</button>
                    </div>
                </div>

            </div>
        </div>
@endif
<!--
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
                                        {{ Form::submit('Join class', ['class'=> 'btn btn-primary']) }}
                                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $session->id)) }}

                                          <select name="quantity" id="quantity" class="btn btn-primary btn-select">
                                            @for($i=1; $i<($session->tickets - count($session->sessionmembers) + 1 ); $i++)
                                            <option value="{{$i}}" {{ (!empty($cart_items[$session->id]) && $cart_items[$session->id] == $i ? 'selected="selected"' : '') }}>{{$i}}</option>
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
                            @if($session->sessionmembers()->count() == 0)
                                <td>

                                    <div class="custom-select bg-white">
                                        {{ Form::select('time', Config::get('evercise.time'), $session->formattedTime(), ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                                    </div>

                                </td>
                                <td>
                                    <div class="custom-select bg-white">
                                        {{ Form::select('duration',Config::get('evercise.duration'),  $session->duration, ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-select bg-white">
                                        {{ Form::select('tickets',Config::get('evercise.tickets'), $session->tickets , ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-select bg-white">
                                        {{ Form::select('price',Config::get('evercise.price'), $session->price, ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions-'.$session->id] ) }}
                                    </div>
                                </td>
                                <td class="text-right">
                                     {{ Form::open(['id' => 'remove-session-'.$session->id, 'route' => 'sessions.remove', 'method' => 'post', 'class' => 'remove-session pull-right ml20']) }}
                                        {{ Form::hidden('id', $session->id) }}
                                        {{ Form::submit('',[ 'class' => 'btn btn-icon icon icon-cross hover']) }}
                                    {{ Form::close() }}

                                    {{ Form::open(['id' => 'update-sessions-'.$session->id, 'route' => 'sessions.update', 'method' => 'put', 'class' => 'update-session hidden']) }}
                                        {{ Form::hidden('id', $session->id) }}
                                        {{ Form::submit('',['class' => 'btn btn-icon icon icon-tick hover ml20' , 'form' => 'update-sessions-'.$session->id]) }}
                                    {{ Form::close() }}
                                </td>
                            @else
                                <td>{{ $session->formattedTime()}}</td>
                                <td>{{ $session->formattedDuration()}}</td>
                                <td><strong>{{ $session->sessionmembers()->count().'/'.$session->tickets}}</strong></td>
                                <td>{{'&pound'. $session->price}}</td>
                                <td class="text-right">
                                    {{ Form::open(['route'=>'session.get.members', 'method'=> 'post', 'class' => 'get-members', 'id'=>'get-members']) }}
                                        <a href="{{route('getPdf', ['session_id' => $session->id])}}" class="icon icon-download mr15 hover"></a>
                                        {{ Form::hidden('session_id', $session->id) }}
                                        {{ Form::submit('', ['class' => 'icon btn-icon icon-people hover']) }}
                                    {{ Form::close() }}

                                </td>

                            @endif

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
                            {{ Form::open(['id' => 'add-new-session', 'route' => 'sessions.store', 'method' => 'post', 'class' => 'add-session collapse hub-add-td pull-right']) }}

                                {{ Form::hidden('evercisegroupId', $evercisegroup_id) }}
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
-->
