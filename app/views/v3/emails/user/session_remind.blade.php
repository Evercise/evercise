@extends('v3.emails.template')

 $params = [
                'subject'      => 'Evercise class reminder',
                'view'         => 'v3.emails.user.session_remind',
                'userList'     => $userList,
                'group'        => $group,
                'location'     => $location,
                'name'         => $name,
                'email'        => $email,
                'dateTime'     => $dateTime,
                'trainerName'  => $trainerName,
                'trainerEmail' => $trainerEmail,
                'classId'      => $classId
            ];



@section('body')





$body = '
<p>Hi ' . $name . ',</p>
<br>
<p>Don`t forget you have a class scheduled for tomorrow!</p>
<br>
<ul>
    <li>Class name: ' . $group . '</li>
    <li>Date and time: ' . date('d-M-Y', strtotime($dateTime)) . ' at ' . date('h:m', strtotime($dateTime)) . '</li>
    <li>Location: ' . $location . '</li>
    <li>Name of trainer: ' . $trainerName . '</li>
</ul>
<br>
<p>Remember to bring a bottle of water and your ID. For those of you with Twitter accounts, let your friends know what you`re up to by using the hashtag #Evercise.</p>
<br>
<p>Most importantly, have fun!</p>
';


$subject = 'Evercise class reminder';
//$view = 'emails.auth.welcome'; // use for validation email
$view = 'emails.template';
$data['title'] = $subject;
$data['mainHeader'] = 'Feeling prepared?';
$data['subHeader'] = 'Your class is tomorrow. Please find all the useful details below.';
$data['body'] = $body;
$data['link'] = HTML::linkRoute('evercisegroups.show', 'Class page', $classId);
$data['linkLabel'] = 'Visit your class page: ';


$data['name'] = $name;
$this->sendTo($email, $subject, $view, $data);

@stop


