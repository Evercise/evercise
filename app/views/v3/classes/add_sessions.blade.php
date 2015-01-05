@extends('v3.layouts.master')
@section('body')
    <div class="container first-container">
        <div class="row text-center mt30">
            <div class="underline">
                <h1>Your class Sessions</h1>
            </div>
            <strong>From this page you can add new sessions to your class and edit any existing sessions</strong>
        </div>
        <div class="row mt40">
            <div class="col-sm-8 col-sm-offset-2">
                <strong>Select Dates</strong>
                <p>Select the dates you want your class to take place. To have a class every Monday for example, simply click/tap the "Mo" and all mondays this month will be added. To remove a day from the section, click it</p>
            </div>
        </div>
        <div class="row">
            {{ Form::open(['route' => 'sessions.store', 'method' => 'post', 'id' => 'add-session']) }}
                <div class="col-sm-8 col-sm-offset-2">
                    <div id="calendar" class="calendar"></div>
                    <!--<div class="row mt50">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{ Form::label('recurring', 'Do your selected sessions recur monthly?', ['class' => 'control-label pull-left mr10'])  }}
                               <label class="custom-checkbox pull-left">
                                 {{ Form::radio('recurring', 'yes') }}
                                 Yes
                               </label>
                               <label class="custom-checkbox pull-left">
                                 {{ Form::radio('recurring', 'no', true) }}
                                 No
                               </label>
                            </div>
                            <div class="pull-left">
                                <small><i>Recurring classes take place the same day each month.</i></small><br>
                                <small><i>Deselect days you do not wish to be recurring.</i></small>
                            </div>


                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                  {{ Form::label('recurring-days', 'Extend recurring classes for:', ['class' => 'mb15'] )  }}
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
                    </div>-->
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
                            {{ Form::hidden('update', true) }}
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
                <h1>Edit your sessions</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div id="update-session">
                        @include('v3.classes.update_sessions_inline')
                    </div>
                </div>
            </div>
            <div class="row mt10 mb30">
                <div class="col-sm-8 col-sm-offset-2 text-right">
                    {{$sessions->links()}}
                </div>

            </div>
            <div class="row mt25 mb50">
                <div class="col-sm-6 col-sm-offset-3">
                    {{ Form::open(['route' => 'sessions.update', 'method' => 'put', 'id' => 'update-sessions']) }}
                        {{ Form::hidden('evercisegroup_id', $data['evercisegroup_id']) }}
                        {{ Form::hidden('preview', 'yes') }}
                        <div class="row">
                            <div class="col-sm-4">
                                {{ Form::submit('Save', ['class' => 'btn btn-default btn-block sm-mb10', 'id' => 'save']) }}
                            </div>
                            <div class="col-sm-4">

                                {{ Form::submit('Save & Preview', ['class' => 'btn btn-primary btn-block sm-mb10']) }}
                            </div>
                            <div class="col-sm-4">
                                <a href="#calendar" id="more-sessions" class="btn btn-default btn-block sm-mb10">More sessions</a>
                            </div>
                        </div>
                    {{ Form::close() }}

                </div>
            </div>

        </div>
    </div>


@stop