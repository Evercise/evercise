@extends('v3.emails.template')
<?php View::share('align', 'center') ?>

@section('body')
<p>Trainers are the heart and soul of Evercise. We know there&apos;s a huge variety of talented trainers and inspirational fitness programs out there and we want everyone to discover just how many unique, fun and fabulous fitness opportunities are on their doorstep. Especially yours!</p>
<p>So congratulations! By joining Evercise you&apos;ve taken the first step towards improved exposure for your fitness business. All you need to do now is start adding classes and enjoy the benefits of Evercise.</p>

<p><strong>Add classes</strong></p>
<p>Now that you&apos;ve set up your profile you can start to list your classes. We&apos;ve made this as easy as possible, simply add classes details to the calendar and edit information such as time, price and duration.</p>
<p>We&apos;ve left plenty of scope for you to make your profile a unique and eye-catching introduction to your services but we&apos;re also on hand to help ensure it makes the right impression.</p>

<p><strong>Manage your account</strong></p>
<p>Once you&apos;re up and running, Evercise makes it easy to manage your account by giving you a user-friendly platform to manage bookings, gain insights into the progress and success of your classes and withdraw money quickly and easily. You can also view statements and see a breakdown of your monthly earnings.</p>

@stop
@section('extra')
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
        <tr>
            <td>
                <br>
                <br>
                <div class="text-center mb30">
                  {{ Html::decode(Html::linkRoute('evercisegroups.create', image('/assets/img/email/btns/btn_get_started_nobg.png', 'Create your first class'), [], ['class' => 'btn btn-blue'])) }}
                </div>
            </td>
        </tr>
    </table>
@stop