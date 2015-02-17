@extends('v3.emails.template')

params = [
            'subject'      => 'Someone has left your class',
            'view'         => 'v3.emails.trainer.session_left',
            'user'     => $user,
            'trainer'        => $trainer,
            'everciseGroup'     => $everciseGroup,
            'sessionDate'         => $sessionDate,
        ];


@section('body')


@stop


