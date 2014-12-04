@extends('v3.emails.template')

params = [
            'subject'      => 'Sorry to see you leave',
            'view'         => 'v3.emails.user.session_left',
            'user'     => $user,
            'trainer'        => $trainer,
            'everciseGroup'     => $everciseGroup,
            'sessionDate'         => $sessionDate,
        ];


@section('body')



      $subject = 'Sorry to see you leave';
             $view = 'emails.session.userLeft';
             $data['display_name'] = $display_name;
             $data['email'] = $email;
             $data['everciseGroup'] = $everciseGroup;
             $data['everciseSession'] = $everciseSession;

             return $this->sendTo($email, $subject, $view, $data);

@stop


