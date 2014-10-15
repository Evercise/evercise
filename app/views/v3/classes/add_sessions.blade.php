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
            <div class="col-sm-8 col-sm-offset-2">
                @include('widgets.calendar', array('month'=>10, 'year'=>2014))
                <div class="row mt50">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('recurring', 'Is this a recurring class?', ['class' => 'control-label pull-left mr10'])  }}
                           <label class="custom-checkbox pull-left">
                             {{ Form::radio('recurring', 'yes', true) }}
                             Yes
                           </label>
                           <label class="custom-checkbox pull-left">
                             {{ Form::radio('recurring', 'no') }}
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
                                         '90' => '90 days',
                                         '120' => '120 days'
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
                                 {{ Form::select('time',
                                     [
                                         '12:00' => '12:00',
                                         '13:00' => '13:00',
                                         '14:00' => '14:00'
                                     ]
                                  , '12:00', ['class' => 'form-control'] ) }}
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group text-center">
                              {{ Form::label('duration', 'Duration', ['class' => 'mb15'] )  }}
                              <div class="custom-select">
                                 {{ Form::select('duration',
                                     [
                                         '30' => '30 mins',
                                         '45' => '45 mins',
                                     ]
                                  , '30', ['class' => 'form-control'] ) }}
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group text-center">
                              {{ Form::label('tickets', 'Tickets', ['class' => 'mb15'] )  }}
                              <div class="custom-select">
                                 {{ Form::select('tickets',
                                     [
                                         '10' => '10',
                                         '15' => '15',
                                     ]
                                  , '10', ['class' => 'form-control'] ) }}
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group text-center">
                              {{ Form::label('price', 'Price (GBP)', ['class' => 'mb15'] )  }}
                              <div class="custom-select">
                                 {{ Form::select('price',
                                     [
                                         '10' => '&pound;10.00',
                                         '15' => '&pound;15.00',
                                     ]
                                  , '10', ['class' => 'form-control'] ) }}
                              </div>
                        </div>
                    </div>
                </div>
                <div class="row mt50 mb50">
                    <div class="col-sm-4 col-sm-offset-4">
                        <button class="btn btn-default btn-block">Save</button>
                    </div>

                </div>
            </div>
        </div>


    </div>

    <div class="container-fluid bg-grey">
        <div class="container">
            <div class="row text-center mt40">
                <div class="underline">
                <h1>Create a class</h1>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Selected Dates</th>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Duration</th>
                                    <th class="text-center">Tickets</th>
                                    <th class="text-center">Price(GBP)</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="text-left"><span>Mon Sept 1st 2014</span></td>

                                    <td>
                                      <div class="custom-select">
                                         {{ Form::select('time',
                                             [
                                                 '12:00' => '12:00',
                                                 '13:00' => '13:00',
                                                 '14:00' => '14:00'
                                             ]
                                          , '12:00', ['class' => 'form-control'] ) }}
                                      </div>
                                    </td>
                                    <td>
                                        <div class="custom-select">
                                           {{ Form::select('duration',
                                               [
                                                   '30' => '30 mins',
                                                   '45' => '45 mins',
                                               ]
                                            , '30', ['class' => 'form-control'] ) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-select">
                                           {{ Form::select('tickets',
                                               [
                                                   '10' => '10',
                                                   '15' => '15',
                                               ]
                                            , '10', ['class' => 'form-control'] ) }}
                                        </div>
                                    </td>
                                    <td>
                                          <div class="custom-select">
                                             {{ Form::select('price',
                                                 [
                                                     '10' => '&pound;10.00',
                                                     '15' => '&pound;15.00',
                                                 ]
                                              , '10', ['class' => 'form-control'] ) }}
                                          </div>
                                    </td>

                                    <td class="text-left">
                                        <span class="icon icon-cross hover"></span>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt25 mb50">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <button class="btn btn-default btn-block">Cancel</button>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-default btn-block">Save & Preview</button>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary btn-block">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop