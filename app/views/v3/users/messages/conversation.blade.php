@extends('v3.layouts.master')
@section('body')
    <div class="container first-container text-center mb50">
        <div class="row">
            <div class="underline">
                <h1>Conversation with {{ (\User::where('display_name', $buddysDisplayName)->first()) ? Html::linkRoute('trainer.show', $buddysDisplayName, strtolower($buddysDisplayName) ) : $buddysDisplayName }}</h1>
            </div>
                @foreach ( $messages as $msg )
                    <p><strong>{{$senderId = $msg->getSender()}}: </strong>{{$content = $msg->getContent()}}</p>
                  @endforeach
                  <div class="">
                    {{ Form::open(array('id' => 'mail_reply', 'url' => 'conversation/'.$buddysDisplayName, 'method' => 'POST', 'class' => 'create-form')) }}
                        <div class="form-group">
                            {{ Form::label('mail_body', 'Reply', ['class' => 'mb15']) }}
                            {{ Form::textarea('mail_body',null, ['placeholder'=>'Type your mail here', 'maxlength'=>1000, 'class' => 'form-control', 'rows' => 6] ) }}
                        </div>
                        <div class="form-group text-center">
                            {{ Form::submit('Reply' , ['class'=>'btn btn-primary']) }}
                        </div>

                    {{ Form::close() }}
        </div>
    </div>
@stop