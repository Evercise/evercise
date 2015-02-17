@extends('v3.emails.template')
<?php View::share('align', 'center') ?>

@section('body')
<p>Hey <strong class="pink-text">{{$trainer->display_name}}</strong></p>
<p>Want to know the key to achieving <strong class="pink-text">50% more sales</strong> on Evercise?</p>
<p>It&apos;s easy! The better your profile is more sales you&apos;re likely to achieve.</p>
<p>Evercise is all about optimising the visibility of your fitness classes but once you&apos;ve got people&apos;s attention we want to make sure you achieve as many conversions as possible by making a great first impression.</p>
<p>Completing your Evercise profile is quick and easy so why not grab a few minutes and tell the world about yourself.</p>
@stop
@section('extra')
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
        <tr>
            <td>
                <br>
                <br>
                <div class="text-center mb30">

                    {{ Html::decode(Html::linkRoute('users.edit', image('/assets/img/email/btns/btn_complete_profile.png', 'Complete Profile'), [$trainer->display_name, 'edit'], ['class' => 'btn btn-blue'])) }}
                </div>
            </td>
        </tr>
    </table>
@stop