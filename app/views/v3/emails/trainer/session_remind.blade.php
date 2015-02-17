 @extends('v3.emails.template')



 @section('body')

<p>Hi <span class="pink-text">{{$trainerName}}</span> ,</p>
<p>Your arranged class <span class="pink-text">{{$group->name}}</span> will take place in less than 24 hours.</p>
<p>Please note that more participants can join up until one hour before the class is due to commence. </p>

{{ Html::decode(Html::linkRoute('getPdf', image('/assets/img/email/btns/btn_download_list.png', 'Manage your upcoming classes'), $sessionId, ['class' => 'btn btn-pink'])) }}

 <p>We hope it goes well!</p>
 @stop
