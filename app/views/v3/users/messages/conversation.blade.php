@extends('v3.layouts.master')
@section('body')
    <div class="container first-container mb50">
        <div class="row text-center">
            <div class="underline">
                <h1>Conversation with {{ (\User::where('display_name', $buddysDisplayName)->first()) ? Html::linkRoute('trainer.show', $buddysDisplayName, strtolower($buddysDisplayName) ) : $buddysDisplayName }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="list-group-accordion" id="list-accordion">

                    <div class="list-group-accordion-body">
                      <div class="list-group-accordion-title">
                          <a data-toggle="collapse" data-parent="#list-accordion" href="#categories" class=""><strong>Conversations</strong></a>
                      </div>
                      <div id="categories" class="panel-collapse">
                        <ul class="list-group">
                            @foreach ( $conversations as $displayName )
                                <li class="list-group-item bg-grey">{{ Html::linkRoute('conversation', $displayName, strtolower($displayName) ) }}</li>
                            @endforeach
                        </ul>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-1">
                <ul class="list-group">
                @foreach ( $messages as $msg )
                    <li class="list-group-item"><strong>{{$msg['display_name']}}: </strong>{{$msg['message']->getContent()}}</li>
                  @endforeach
                  </ul>

                {{ Form::open(array('id' => 'mail_reply', 'url' => 'conversation/'.$buddysDisplayName, 'method' => 'POST', 'class' => 'create-form')) }}
                    <div class="form-group">
                        {{ Form::label('mail_body', 'Reply', ['class' => 'mb15']) }}
                        {{ Form::textarea('mail_body',null, ['placeholder'=>'Type your mail here', 'maxlength'=>1000, 'class' => 'form-control', 'rows' => 6] ) }}
                    </div>
                    <div class="form-group text-right">
                        {{ Form::submit('Reply' , ['class'=>'btn btn-primary']) }}
                    </div>

                {{ Form::close() }}
            </div>

        </div>
    </div>
@stop