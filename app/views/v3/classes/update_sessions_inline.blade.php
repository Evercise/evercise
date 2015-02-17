
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
                            {{ Form::select('time[]', Config::get('evercise.time'), $session->date_time->format('H:i'), ['class' => 'form-control input-sm update-session-select', 'form' => 'update-sessions'] ) }}
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