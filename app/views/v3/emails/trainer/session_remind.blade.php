 @extends('v3.emails.template')



 @section('body')

<p>onfirmation email 24h before the class</p>
<p>Hi {{$trainerName}},</p>
<p>Your arranged class will take place in less than 24 hours.</p>
<p>Please note that more participants can join up until one hour before the class is due to commence. </p>

<a href="{{route('getPdf', ['session_id' => $sessionId])}}" >Download Class List</a>

 @stop
 @section('extra')

 <p>We hope it goes well!</p>
 <p>Button: Manage your upcoming classes</p>

{{ Html::decode(Html::linkRoute('users.edit', image('/assets/img/email/btns/btn_get_started.png', 'Manage your upcoming classes'), [$trainerName, 'hub'], ['class' => 'btn btn-blue'])) }}

 @stop
