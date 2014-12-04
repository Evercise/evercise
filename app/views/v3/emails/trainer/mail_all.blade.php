@extends('v3.emails.template')

$params = [

                'subject'        => 'You have a new message',
                'view'           => 'v3.emails.trainer.mail_all',
                'trainer'        => $trainer,
                'name'           => $name,
                'email'          => $email,
                'userList'       => $userList,
                'group'          => $group,
                'messageSubject' => $messageSubject,
                'messageBody'    => $messageBody
            ];


@section('body')



      $emailBody = '
      				<p>Hi ' . $name . ',</p>
      				<br>
      				<p>You’ve received a new message through Evercise from ' . $trainer . ', who is running the class ' . $group . '.</p>
      				<br>
      				<p>Please see the message below:</p>
      				<br>
      				<p>' . $messageSubject . '</p>
      				<br>
      				<p>' . $messageBody . '</p>
      			';

                  $data['body'] = $emailBody;
                  $data['name'] = $name;
                  $this->sendTo($email, $subject, $view, $data);



@stop