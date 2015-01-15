@extends('v3.emails.template')



@section('body')

<strong>Hey <span class="pink-text">{{$trainer->display_name}}</span> </strong>
<p><span class="pink-text">{{$user->display_name}}</span> has joined your class <span class="pink-text">{{$evercisegroup->name}}</span> on the <span class="pink-text">{{date('M jS, g:ia', strtotime($session->date_time)) }}</span></p>

<?php $bookingCodes = $transaction->makeBookingHashBySession($session->id) ?>
@if(! empty($bookingCodes))
    <p>Below are the booking codes:</p>
    @foreach( as $hash)
        <p>{{ $hash }}</p>
    @endforeach
@endif

{{ Html::decode(Html::linkRoute('trainer', image('/assets/img/email/btns/btn_get_started.png', 'Manage your class'), [], ['class' => 'btn btn-blue'])) }}

@stop