@extends('v3.emails.template')
<?php View::share('align', 'center') ?>

@section('body')
<p>We&apos;re delighted you&apos;ve decided to join the Evercise Pay As You Go Fitness revolution and we reckon you&apos;ll be just as thrilled with what Evercise can do for you.</p>
<p>Trainers are the heart and soul of Evercise. We know there&apos;s a huge variety of talented trainers and inspirational fitness programs out there and we want everyone to discover just how many unique, fun and fabulous fitness opportunities are on their doorstep. Especially yours!</p>
<p>All you need to do now is set up your profile and start enjoying the benefits of Evercise.</p>
@stop
@section('extra')
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="30" bgcolor="#ff1b7e">
        <tr width="100%">
            <td width="33%">
                <div class="mb30">
                    {{ image('/img/home/wie.png') }}
                </div>
            </td>
            <td width="67%">
                <h3 class="white-text">Set up your Profile.</h3>
                <p class="white-text">Just click on the Get Started button below and we&apos;ll guide you through the process of setting up your unique Evercise Profile.</p>
            </td>
        </tr>
    </table>
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="30" bgcolor="#ff1b7e">
        <tr width="100%">
            <td width="67%">
                <h3 class="white-text text-right">Add classes.</h3>
                 <p class="white-text text-right">Once you&apos;ve set up your profile you can start to list your classes.</p>
            </td>
            <td width="33%">
                {{ image('/img/home/wie.png') }}
            </td>
        </tr>
    </table>
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="30" bgcolor="#ff1b7e">
        <tr width="100%">
            <td width="33%">
                {{ image('/img/home/wie.png') }}
            </td>
            <td width="67%">
                <h3 class="white-text">Manage your account.</h3>
                <p class="white-text">Once you&apos;re up and running Evercise makes it easy to manage your account manage bookings, gain insights into the progress and success of your classes and withdraw money quickly and easily.</p>
            </td>
        </tr>
    </table>
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="30" bgcolor="#ff1b7e">
        <tr>
            <td>
                <br>
                <br>
                <div class="text-center mb30">
                    {{ Html::decode(Html::linkRoute('users.edit', image('/assets/img/email/btns/btn_get_started.png', 'Get Started'), [$trainer->display_name], ['class' => 'btn btn-blue'])) }}
                </div>
            </td>
        </tr>
    </table>
@stop