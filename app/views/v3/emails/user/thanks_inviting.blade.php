@extends('v3.emails.template')
<?php View::share('align', 'center') ?>

@section('body')

<p>Hey {{$referrerName}}</p>
<p>Thanks for referring {{$email}}!</p>
<p>As soon as they sign up we&apos;ll update your Evercise account with a &pound;{{Config::get('values')['milestones']['referral']['reward']}} reward, giving you &pound;{{$balanceWithBonus}} available to book new classes.</p>
<p>Why not visit Evercise to check out new classes in your area.</p>

@stop
@section('extra')

    {{ Html::decode(Html::linkRoute('evercisegroups.search', image('/assets/img/email/btns/btn_discover.png', 'DISCOVER NEW CLASSES'), [$user->display_name], ['class' => 'btn btn-blue'])) }}

@stop