@extends('v3.emails.template')

$params = [
                'subject'        => 'You have a new message',
                'view'           => 'v3.emails.trainer.mail_trainer',
                'trainer'        => $trainer,
                'user'           => $user,
                'dateTime'       => $dateTime,
                'name'           => $name,
                'email'          => $email,
                'group'          => $group,
                'messageSubject' => $messageSubject,
                'messageBody'    => $messageBody
            ];


@section('body')



      $emailBody = '
      				<p>Hi ' . $name . ',</p>
      				<br>
      				<p>You’ve received a new message through Evercise from ' . $user . ', who will be taking part in your class ' . $group . '.</p>
      				<br>
      				<p>Please see the message below:</p>
      				<br>
      				<p>' . $messageSubject . '</p>
      				<br>
      				<p>' . $messageBody . '</p>
      			';


                  $subject = 'You have a new message.';
                  $view = 'emails.template';
                  $data['title'] = $subject;
                  $data['mainHeader'] = 'You have a new message in your Evercise inbox.';
                  $data['subHeader'] = 'A participant has contacted you.';
                  $data['body'] = $emailBody;
                  $data['link'] = 'http://evercise.com';
                  $data['linkLabel'] = 'evercise.com';

                  $data['name'] = $name;
                  $this->sendTo($email, $subject, $view, $data);



@stop