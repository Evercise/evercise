@extends('v3.layouts.master')
@section('body')
    <div class="container first-container">
        <div class="row text-center mt30">
            <div class="underline">
                <h1>Create a class</h1>
            </div>
            <strong>Some type of instructions for the trainer to continue</strong>
        </div>
        <div class="row mt40">
            <div class="col-sm-8 col-sm-offset-2">
                <strong>Select Dates</strong>
                <p>Select the dates you want your class to take place. To have a class every Monday for example, simply click/tap the "Mo" and all mondays (for 3 months) will be added. To remove a day from the section, click it</p>
            </div>
        </div>
        <div class="row">
            {{ Form::open(['route' => 'sessions.store', 'method' => 'post', 'id' => 'add-session']) }}
                <div class="col-sm-8 col-sm-offset-2">
                    <div id="calendar" class="calendar"></div>
                    <div class="row mt50">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{ Form::label('recurring', 'Is this a recurring class?', ['class' => 'control-label pull-left mr10'])  }}
                               <label class="custom-checkbox pull-left">
                                 {{ Form::radio('recurring', 'yes') }}
                                 Yes
                               </label>
                               <label class="custom-checkbox pull-left">
                                 {{ Form::radio('recurring', 'no', true) }}
                                 No
                               </label>
                            </div>
                           <small><i>Recurring classes take place the day same every week.</i></small><br>
                           <small><i>Deselect days you do not wish to be recurring.</i></small>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                  {{ Form::label('recurring-days', 'Run recurring class for:', ['class' => 'mb15'] )  }}
                                  <div class="custom-select">
                                     {{ Form::select('recurring-days',
                                         [
                                             '1' => '1 month',
                                             '2' => '2 months',
                                             '3' => '3 months'
                                         ]
                                      , '90', ['class' => 'form-control'] ) }}
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt20">
                        <div class="col-sm-3">
                            <div class="form-group text-center">
                                  {{ Form::label('time', 'Time', ['class' => 'mb15'] )  }}
                                  <div class="custom-select">
                                     {{ Form::select('time', Config::get('evercise.time'), '12:00', ['class' => 'form-control '] ) }}
                                  </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group text-center">
                                  {{ Form::label('duration', 'Duration', ['class' => 'mb15'] )  }}
                                  <div class="custom-select">
                                     {{ Form::select('duration', Config::get('evercise.duration'), '30', ['class' => 'form-control'] ) }}
                                  </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group text-center">
                                  {{ Form::label('tickets', 'Tickets', ['class' => 'mb15'] )  }}
                                  <div class="custom-select">
                                     {{ Form::select('tickets', Config::get('evercise.tickets'), '10', ['class' => 'form-control'] ) }}
                                  </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group text-center">
                                  {{ Form::label('price', 'Price (GBP)', ['class' => 'mb15'] )  }}
                                  <div class="custom-select">
                                     {{ Form::select('price', Config::get('evercise.price'), '10', ['class' => 'form-control'] ) }}
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt50 mb50">
                        <div class="col-sm-4 col-sm-offset-4">
                            {{ Form::hidden('evercisegroup_id', $data['evercisegroup_id']) }}
                            {{ Form::hidden('session_array', null ) }}
                            {{ Form::submit('Save', ['class' => 'btn btn-default btn-block']) }}
                        </div>

                    </div>
                </div>
            {{ Form::close() }}
        </div>


    </div>

    <div class="container-fluid bg-grey" id="update-container">
        <div class="container">
            <div class="row text-center mt40">
                <div class="underline">
                <h1>Create a class</h1>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div id="update-session">
                        @include('v3.classes.update_sessions_inline')
                    </div>
                </div>
            </div>
            <div class="row mt25 mb50">
                <div class="col-sm-6 col-sm-offset-3">
                    {{ Form::open(['route' => 'sessions.update', 'method' => 'put', 'id' => 'update-sessions']) }}
                        <div class="row">
                            <div class="col-sm-4">
                                <button class="btn btn-default btn-block">Cancel</button>
                            </div>
                            <div class="col-sm-4">
                                {{ Form::hidden('$evercisegoupId', $data['evercisegroup_id']) }}
                                {{ Form::hidden('preview', 'yes') }}
                                {{ Form::submit('Save & Preview', ['class' => 'btn btn-default btn-block']) }}
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary btn-block">Create</button>
                            </div>
                        </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>


@stop