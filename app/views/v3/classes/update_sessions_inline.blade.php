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

                    <tr class="text-center" id="update-row-{{$session->id}}">

                        <td class="text-left"><span>{{ $session->formattedDate()}}</span></td>
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

                    </tr>
                    {{ Form::hidden('id[]', $session->id, ['form' =>'update-sessions', 'id' => 'update-id-'.$session->id]) }}

                @endforeach


            </tbody>
        </table>
    </div>
</div>
