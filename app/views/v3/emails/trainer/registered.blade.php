@extends('v3.emails.template')
<?php View::share('align', 'center') ?>

@section('body')
<p>It&apos;s great to have you on board. We’re delighted you’ve decided to join the
   Evercise Pay As You Go Fitness revolution and we reckon you’ll be just as
   thrilled with what Evercise can do for you! Your application is being
   processed but you can start creating classes straight away. This should take
   no longer than two working days for your profile to become visible to the
   public.
</p>
<p>Thank you for your patience.</p>

{{ Html::decode(Html::linkRoute('evercisegroups.create', image('/assets/img/email/btns/btn_get_started.png', 'Create your first class'), [], ['class' => 'btn btn-blue'])) }}

@stop
