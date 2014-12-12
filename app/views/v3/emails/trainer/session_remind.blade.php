 @extends('v3.emails.template')



 @section('body')

<p>Hi <span class="blue-text">{{$trainerName}}</span> ,</p>
<p>Your arranged class <span class="blue-text">{{$group->name}}</span> will take place in less than 24 hours.</p>
<p>Please note that more participants can join up until one hour before the class is due to commence. </p>

{{ Html::decode(Html::linkRoute('getPdf', image('/assets/img/email/btns/btn_get_started.png', 'Manage your upcoming classes'), $sessionId, ['class' => 'btn btn-blue'])) }}

 <p>We hope it goes well!</p>
 @stop
