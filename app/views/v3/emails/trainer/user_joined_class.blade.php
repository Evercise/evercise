@extends('v3.emails.template')

{{-- NOT USED. REPLACED BY user_joined_classes --}}

@section('body')

<strong>Hey <span class="pink-text">{{$trainer->display_name}}</span> </strong>
<p><span class="pink-text">{{$user->display_name}}</span> has joined your class <span class="pink-text">{{$evercisegroup->name}}</span> on the <span class="pink-text">{{date('M jS, g:ia', strtotime($session->date_time)) }}</span></p>






{{ Html::decode(Html::linkRoute('trainer', image('/assets/img/email/btns/btn_manage_blue.png', 'Manage your class'), [], ['class' => 'btn btn-blue'])) }}

@stop