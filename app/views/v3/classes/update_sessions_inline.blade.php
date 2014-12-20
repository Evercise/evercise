<!--
<div class="row  collapse in hub-table-row">
    <div class="table-responsive col-sm-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Dates</th>
                    <th class="text-center">Time</th>
                    <th class="text-center">Duration</th>
                    <th class="text-center">Tickets</th>
                    <th class="text-center">Price (GBP)</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
                    <tr class="text-center" id="hub-edit-row-{{$session->id}}">

                        <td class="text-left"><span>{{ $session->formattedDate()}}</span></td>
                        @if($session->sessionmembers()->count() == 0)
                            <td>
                                <div class="custom-select">
                                    {{ Form::select('time[]', Config::get('evercise.time'), $session->formattedTime(), ['class' => 'form-control input-sm', 'form' => 'update-sessions'] ) }}
                                </div>
                            </td>
                            <td>
                                <div class="custom-select">
                                    {{ Form::select('duration[]',Config::get('evercise.duration'),  $session->duration, ['class' => 'form-control input-sm', 'form' => 'update-sessions'] ) }}
                                </div>
                            </td>
                            <td>
                                <div class="custom-select">
                                    {{ Form::select('tickets[]',Config::get('evercise.tickets'), $session->tickets , ['class' => 'form-control input-sm', 'form' => 'update-sessions'] ) }}
                                </div>
                            </td>
                            <td>
                                <div class="custom-select">
                                    {{ Form::select('price[]',Config::get('evercise.price'), $session->price, ['class' => 'form-control input-sm', 'form' => 'update-sessions'] ) }}
                                </div>
                            </td>
                            <td class="text-left">
                                {{ Form::open(['id' => 'remove-session-'.$session->id, 'route' => 'sessions.remove', 'method' => 'post', 'class' => 'remove-session']) }}
                                    {{ Form::hidden('id', $session->id) }}
                                    {{ Form::submit('',[ 'class' => 'btn btn-icon icon icon-cross hover']) }}
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
                    {{ Form::hidden('id[]', $session->id, ['form' =>'update-sessions', 'id' => 'update-id-'.$session->id]) }}

                @endforeach


            </tbody>
        </table>
    </div>
</div>
-->
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
                            {{ Form::select('time[]', Config::get('evercise.time'), $session->formattedTime(), ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions'] ) }}
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
                            {{ Form::select('duration[]',Config::get('evercise.duration'),  $session->duration, ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions'] ) }}
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
                            {{ Form::select('tickets[]',Config::get('evercise.tickets'), $session->tickets , ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions'] ) }}
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
                            {{ Form::select('price[]',Config::get('evercise.price'), $session->price, ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions'] ) }}
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

                        {{ Form::open(['id' => 'update-sessions', 'route' => 'sessions.update', 'method' => 'put', 'class' => 'update-session hidden']) }}
                            {{ Form::hidden('id', $session->id) }}
                            {{ Form::submit('',['class' => 'btn btn-icon icon icon-tick hover ml20' , 'form' => 'update-sessions']) }}
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
    {{ Form::hidden('id[]', $session->id, ['form' =>'update-sessions', 'id' => 'update-id-'.$session->id]) }}
@endforeach